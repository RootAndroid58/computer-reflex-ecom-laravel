<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;

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
        dd($req);
    }






















    public function CartCheckoutView()
    {   
        $cart = Cart::where('user_id', Auth()->user()->id)->with('CheckoutProducts')->where('qty', '>=', 'CheckoutProducts.product_stock')->orderBy('id', 'asc')->get();
        $addresses = Address::where('user_id', Auth()->user()->id)->get();
        $cartCount = $cart->count();

        return view('checkout', [
            'cart'      => $cart,
            'cartCount' => $cartCount,
            'addresses' => $addresses,
        ]);
    }



    public function CartCheckout(Request $req)
    {
        $address = Address::where('id', $req->address_id)->where('user_id', Auth()->user()->id)->first();

        if (isset($address)) {

            $cart = Cart::where('user_id', Auth()->user()->id)->with('CheckoutProducts')->where('qty', '>=', 'CheckoutProducts.product_stock')->orderBy('id', 'asc')->get();
            
            $total_price = 0;
            $productCount = 0;

            foreach ($cart as $cart) {

                if ($cart->CheckoutProducts != null && $cart->qty <= $cart->CheckoutProducts->product_stock) {
                   
                    $total_price += $cart->qty * $cart->CheckoutProducts->product_price;
                    $total_mrp += $cart->qty * $cart->CheckoutProducts->product_mrp;
                    $productCount += 1;

                    $orderItem = new OrderItem;
                    $orderItem->product_id = $cart->product_id;
                    $orderItem->qty = $cart->qty;
                    $orderItem->unit_price = $cart->CheckoutProducts->product_price;
                    $orderItem->total_price = $cart->qty * $cart->CheckoutProducts->product_price;
                    $orderItem->save();
                }
            } 

            // If number of items is greater than 0 then create order. 
            if ($productCount > 0) {
                $order = new Order;
                $order->user_id         = Auth()->user()->id;
                $order->address_id      = $req->address_id;
                $order->price           = $total_price;
                $order->mrp             = $total_mrp;
                $order->payment_method  = $req->PaymentMethod;
                $order->status          = 'pending';
                $order->save();
            } 
            else {
                return redirect()->back();
            }

            return 'Order Placed';
        }

    }

    public function CreateOrder($product, $total_price, $status)
    {
        $order = new Order;

        $order->user_id = Auth()->user()->id;
        $order->address_id = '';
        $order->price = '';
        $order->payment_method = '';
        $order->status = '';

        dd($order);
    }
}
