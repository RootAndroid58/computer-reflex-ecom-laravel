<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Mail\OrderPlacedMail;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    public function CheckoutView(Request $req)
    {
        $addresses = Address::where('user_id', Auth()->user()->id)->get();

        foreach ($req->product_id as $key => $value) {
            $data[] = Product::with('images')->where('id', $value)->first();
            $qty[] = $req->product_qty[$key];
        }

        return view('checkout-form', [
            'data'      => $data,
            'qty'       => $qty,
            'addresses' => $addresses,
        ]);
    }

    public function CheckoutSubmit(Request $req)
    {   
        $address = Address::where('user_id', Auth()->user()->id)->where('id', $req->address_id)->first();
           
        if (!isset($address)) {  // Check if address is invalid then abort 
            abort(500); 
        }

        // Calculate the MRP & Price 
        $mrp        = 0; // Default MRP
        $price      = 0; // Default Price
        $itemCount  = 0; // Default Item Count

        foreach ($req->product_id as $i => $pid) {
            $product = Product::where('id', $pid)->first();
            if ($product->product_stock >= $req->product_qty[$i]) {
                $mrp        += $product->product_mrp * $req->product_qty[$i];
                $price      += $product->product_price * $req->product_qty[$i];
                $itemCount  += 1;
            } else {
                return redirect()->route('cart');
            }
        }

        // Abort if no items for checkout 
        if ($itemCount <= 0) {
            abort(500);
        }

        // Create new order 
        $order = new Order;
        $order->user_id         = Auth()->user()->id;
        $order->address_id      = $req->address_id;
        $order->mrp             = $mrp;
        $order->price           = $price;
        $order->payment_method  = $req->payment_method;
        $order->status          = 'checkout_pending';
        $order->delivery_date   = date_create(date('y-m-d h:m:s', strtotime ('+10 day')));
        $order->save();

        // Add items for order
        foreach ($req->product_id as $key => $pid) {
            $prod = Product::where('id', $pid)->first();
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $pid;
            $orderItem->qty = $req->product_qty[$key];
            $orderItem->unit_price = $prod->product_price;
            $orderItem->total_price = $prod->product_price * $req->product_qty[$key];
            $orderItem->save();
        }

        // Send user to paytm for payment
        if ($req->payment_method == 'paytm') 
        {
            $paytmParam = [ 
                'ORDER_ID' => $order->id,
                'CUST_ID' => Auth()->user()->id,
                'TXN_AMOUNT' => $price,
                'MOBILE_NO' => Auth()->user()->mobile,
                'EMAIL' => Auth()->user()->email,
                'CALLBACK_URL' => route('checkout-paytm-response'),
            ];
    
            $payment = Indipay::gateway('Paytm')->prepare($paytmParam);
            return Indipay::process($payment);
        } 

        // Send user to PayU for payment
        else if ($req->payment_method == 'payu') 
        {
            $payuParam = [ 
                'txnid' => $order->id,
                'amount' => $price,
                'productinfo' => 'Order on ComputerReflex',
                'firstname' => Auth()->user()->name,
                'phone' => Auth()->user()->mobile,
                'email' => Auth()->user()->email,
                'surl' => route('checkout-payu-response'),
                'furl' => route('checkout-payu-response'),
            ];
    
            $payment = Indipay::gateway('PayUMoney')->prepare($payuParam);
            return Indipay::process($payment);
        } 

        // Process COD Order
        elseif ($req->payment_method == 'cod') 
        {
            Order::where('id', $order->id)->update([
                'status' => 'order_placed',
            ]);

            return redirect()->route('checkout-order-confirmation', $order->id);
            // return $this->AfterPayment($order->id);
        }

    }

    // Process after payment
    public function AfterPayment($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth()->user()->id)->first();

        // Redirect back if order is invalid or not right user.
        if (!isset($order)) {
            return redirect()->back();
        }

        $address = Address::where('id', $order->address_id)->first();
        $items = OrderItem::where('order_id', $order->id)->with('product')->with('image')->get();
        $data = [
            'order'         => $order,
            'items'         => $items,
            'address'       => $address,
        ];

        // Process the order as Placed
        if ($order->status == 'order_placed') 
        {
            mail::to(Auth()->user()->email)->send(new OrderPlacedMail($data));  

            return view('checkout.success', [
                'data' => $data,
            ]);
        }
        // Process the order as Payment Failed
        else if ($order->status == 'payment_failed') 
        {
            return view('checkout.failed', [
                'data' => $data,
            ]);
        } 
        // Process the order as Payment Pending
        else 
        {
            return view('checkout.pending', [
                'data' => $data,
            ]);
        }
        

        
    }


    public function PaytmResponse(Request $req)
    {
        if ($req->STATUS == 'TXN_SUCCESS') {
            Order::where('id', $req->ORDERID)->update([
                'status' => 'order_placed'
            ]);
    
            return redirect()->route('checkout-order-confirmation', $req->ORDERID);
        }

        else if ($req->STATUS == 'TXN_FAILURE') {
            Order::where('id', $req->ORDERID)->update([
                'status' => 'payment_failed'
            ]);

            return redirect()->route('checkout-order-confirmation', $req->ORDERID);
        }

        else {
            Order::where('id', $req->ORDERID)->update([
                'status' => 'payment_pending'
            ]);

            return redirect()->route('checkout-order-confirmation', $req->ORDERID);
        }

    }
    
    public function PayuResponse(Request $req)
    { dd($req);
        if ($req->status == 'TXN_SUCCESS') {
            Order::where('id', $req->txnid)->update([
                'status' => 'order_placed'
            ]);
    
            return redirect()->route('checkout-order-confirmation', $req->txnid);
        }

        else if ($req->status == 'TXN_FAILURE') {
            Order::where('id', $req->txnid)->update([
                'status' => 'payment_failed'
            ]);

            return redirect()->route('checkout-order-confirmation', $req->txnid);
        }

        else {
            Order::where('id', $req->txnid)->update([
                'status' => 'payment_pending'
            ]);

            return redirect()->route('checkout-order-confirmation', $req->txnid);
        }
    }


}
