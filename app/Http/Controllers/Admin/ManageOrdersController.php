<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\OrderCancelRequest;
use App\Models\ProductLicense;
use App\Models\OrderItemLicense;
use Softon\Indipay\Facades\Indipay;
use App\Http\Helpers\PaytmHelper;
use App\Http\Helpers\PayuHelper;

use App\Mail\ItemDeliveredMail;

use DateTime;
use Mail;

use Seshac\Shiprocket\Shiprocket;

class ManageOrdersController extends Controller
{
    public function ViewManageOrders()
    {
        return view('admin.manage-orders');
    }

    public function ShipOrdersPage()
    {
        return view('admin.shipping.ship-orders');
    }

    public function DeliveryConfirmationPage()
    {
        return view('admin.manage-orders.delivery-confirmation');
    }

    public function ItemDeliveredConfirmation ($order_item_id)
    {
        $OrderItem = OrderItem::where('id', $order_item_id)->first();
        if (isset($OrderItem)) {
            if ($OrderItem->status == 'item_shipped') {
                $OrderItem->where('id', $order_item_id)->update([
                    'status' => 'item_delivered',
                ]);
            }

            $a = OrderItem::where('order_id', $OrderItem->order_id)->get();
            $b = OrderItem::where('order_id', $OrderItem->order_id)->where('status', 'item_delivered')->get();
            
            if ($a->count() == $b->count()) {
                Order::where('id', $OrderItem->order_id)->update([
                    'status' => 'order_delivered',
                ]);
                // admin-delivery-confirmation
            } 

            return redirect()->route('admin-delivery-confirmation')->with([
                'ItemDelivered' => $OrderItem->order_id,
            ]);
        }
    }

    public function CheckAndMarkDelivered($order_id)
    {
        $a = OrderItem::where('order_id', $order_id)->get();
        $b = OrderItem::where('order_id', $order_id)->where('status', 'item_delivered')->get();
            
            if ($a->count() == $b->count()) {
                Order::where('id', $order_id)->update([
                    'status' => 'order_delivered',
                ]);
                // admin-delivery-confirmation
            } 
    }

    public function ShipOrder ($order_id)
    {
        $order = Order::with('OrderItems.OrderItemLicenses.ProductLicense')->where('id', $order_id)->first();

        return view('admin.shipping.process-order',[
            'order' => $order,
        ]);
        
    }

    public function StartPacking($order_item_id)
    {
        $OrderItem = OrderItem::where('id', $order_item_id)->where('status', 'order_placed')->first();
        
        if (isset($OrderItem)) {
            OrderItem::where('id', $order_item_id)->update([
                'status' => 'packing_started',
            ]);

            return redirect()->route('admin-ship-order', $OrderItem->order_id);
        }

    }

    public function CompletePacking($order_item_id)
    {
        $OrderItem = OrderItem::where('id', $order_item_id)->where('status', 'packing_started')->first();
        
        if (isset($OrderItem)) {
            OrderItem::where('id', $order_item_id)->update([
                'status' => 'packing_completed',
            ]);

            return redirect()->route('admin-ship-order', $OrderItem->order_id);
        }

    }

    public function CreateShipmentView($order_item_id)
    {
        $OrderItem = OrderItem::with('product')->where('id', $order_item_id)->first();
        if (isset($OrderItem) && $OrderItem->status == 'packing_completed') {
            return view('admin.shipping.create-shipment', [
                'item' => $OrderItem,
            ]);
        } else {
            abort(500);
        }
        
    }



    public function CreateShipment($order_id)
    {
        $order = Order::with('OrderItems')->with('address')->where('id', $order_id)->first();

        foreach ($order->OrderItems as $key => $OrderItem) {
            if ($OrderItem->status != 'packing_completed') {
                abort(500);
            }
        }
       
        if ($order->OrderItems->count() < 1) {
            abort(500);
        }

        return view('admin.shipping.create-shipment', [
            'order'         => $order,
            'orderItems'    => $order->OrderItems,
        ]);
    }

    
    public function CancelReviewSubmit(Request $req)
    {
        $req->validate([
            'cancel_review'     => 'required',
        ]); 

        $order = Order::with('ForwardShipment')->where('id', $req->order_id)->with('PendingCancelRequest')->first();
       
        if (!isset($order->PendingCancelRequest)) {
            abort(500);
        }

        if ($order->status != 'order_placed') {
            abort(500);
        }

        if ($req->cancel_review == 'approve') {
            // Cancel the order on Shiprocket.
            if (isset($order->ForwardShipment->shiprocket_order_id)) {
                $shiprocketCancel =  Shiprocket::order(Shiprocket::getToken())->cancel(['ids' => [$order->ForwardShipment->shiprocket_order_id]]);
            }

            $this->FullOrderRefund($order);

            // Update Order Cancellation Request
            OrderCancelRequest::where('id', $order->PendingCancelRequest->id)->update([
                'status' => 'approved',
            ]);
            // Cancel The Order
            Order::where('id', $order->id)->update([
                'status' => 'order_cancelled',
            ]);
            // Update All Ordered Items
            OrderItem::where('order_id', $order->id)->update([
                'status' => 'order_cancelled',
            ]);

            

        }

        if ($req->cancel_review == 'decline') {

            $req->validate([
                'review_comment' => 'required',
            ]);

            OrderCancelRequest::where('id', $order->PendingCancelRequest->id)->update([
                'status'    => 'rejected',
                'remarks'   => $req->review_comment,
            ]);
        }
        
        return redirect()->back();
    }

    public function FullOrderRefund($order)
    {

        // Initiate refund via Paytm
        if ($order->payment_method == 'paytm') {
            $txnStatus = PaytmHelper::status([
                'orderId' => $order->id,
            ]);
            $refund = PaytmHelper::refund([
                'txnType' => 'REFUND',
                'orderId' => $order->id,
                'txnId' => $txnStatus->txnId,
                'refId' => 'REVERSAL-'.$order->id,
                'refundAmount' => $order->price,
                'comments' => 'Order Amount Refund From'.config('app.name'),
            ]);
        } 

        // Initiate refund via PayU
        if ($order->payment_method == 'payu') {
            
        }
    }

    public function SendLicenseKey(Request $req)
    {
        $req->validate([
            'order_item_id' => 'required',
        ]);

        $OrderItem = OrderItem::where('id', $req->order_item_id)->first();
        
        if (!isset($OrderItem)) {
           abort(500);
        }
        
        if ($OrderItem->status != 'order_placed') {
            return 'License key already sent!';
        }
       
        $req->validate([
            'license_keys.*'    => 'distinct|required',
            'license_keys'      => 'unique:product_licenses,key,NULL,id,product_id,'.$OrderItem->product_id,
        ]);
        
        if ($OrderItem->qty != count($req->license_keys)) {
            abort(500);
        }

        OrderItem::where('id', $req->order_item_id)->update([
            'status' => 'item_delivered',
        ]);

        foreach ($req->license_keys as $key => $license_key) {
            $ProductLicense = new ProductLicense;
            $ProductLicense->product_id = $OrderItem->product_id;
            $ProductLicense->key = $license_key;
            $ProductLicense->status = 'used';
            $ProductLicense->save();

            $OrderItemLicense = new OrderItemLicense;
            $OrderItemLicense->order_item_id = $OrderItem->id;
            $OrderItemLicense->product_license_id = $ProductLicense->id;
            $OrderItemLicense->delivery_date = new \DateTime();
            $OrderItemLicense->save();
        }

        $data = [
            'OrderItem' => $OrderItem,
        ];

        Mail::to($OrderItem->order->User->email)->send(new ItemDeliveredMail($data));

        $this->CheckAndMarkDelivered($OrderItem->order_id);

        return redirect()->back();
    }


    public function CreateShipmentSubmit(Request $req)
    {
        Shipment::where('active', 0)->delete();
        
        $req->validate([
            'order_id'      => 'required|exists:orders,id',
            'buyer_name'    => 'required',
            'house_no'      => 'required',
            'locality'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'state'         => 'required',
            'pin_code'      => 'required',
            'mobile'        => 'required|digits:10',
            'alt_mobile'    => 'nullable|digits:10',
            'length'        => 'required',
            'height'        => 'required',
            'weight'        => 'required',
        ]);
         
        $order = Order::with('Address')->with('OrderItems.shipment')->with('User')->where('id', $req->order_id)->first();
    
            if (!isset($order) && $order->status != 'order_placed') {
                abort(500);
            } 

            foreach ($order->OrderItems as $key => $OrderItem) {
                if ($OrderItem->status != 'packing_completed' && isset($OrderItem->shipment)) {
                    abort(500);
                }
            }

            OrderAddress::where('order_id', $order->id)->update([
                'name' => $req->buyer_name,
                'house_no' => $req->house_no,
                'locality' => $req->locality,
                'city' => $req->city,
                'district' => $req->district,
                'state' => $req->state,
                'pin_code' => $req->pin_code,
                'mobile' => $req->mobile,
                'alt_mobile' => $req->alt_mobile,
            ]);
           
            $order = Order::with('Address')->with('OrderItems')->with('User')->where('id', $req->order_id)->first();

            foreach ($order->OrderItems as $key => $OrderItem) { 

                $shipment = new Shipment;
                $shipment->order_item_id = $OrderItem->id;
                $shipment->type = 'forward';
                $shipment->order_id = $order->id;
                $shipment->courier_name = 'Shiprocket';
                $shipment->tracking_id = 'Not Available';
                $shipment->active = 0;
                $shipment->save();

                $shippingItems[] = [
                    'name'          => $OrderItem->product->product_name, 
                    'sku'           => $OrderItem->product->id, 
                    'units'         => $OrderItem->qty, 
                    'selling_price' => $OrderItem->unit_mrp, 
                    'discount'      => $OrderItem->unit_mrp - $OrderItem->unit_price, 
                ];
            }

            if ($order->payment_method == 'cod') { 
                $payment_method = "COD";
            } else { 
                $payment_method = "Prepaid";
            }

        
            $ShiprocketParams = [
                'order_id'                  => $order->id,
                'order_date'                => $order->created_at,
                'pickup_location'           => 'Aniket',
                'billing_customer_name'     => $order->Address->name,
                'billing_last_name'         => '',
                'billing_address'           => $order->Address->house_no,
                'billing_city'              => $order->Address->city,
                'billing_pincode'           => $order->Address->pin_code,
                'billing_state'             => $order->Address->state,
                'billing_country'           => 'India',
                'billing_email'             => $order->User->email,
                'billing_phone'             => $order->Address->mobile,
                'billing_alternate_phone'   => $order->Address->alt_mobile ?? '',
                'shipping_is_billing'       => true,
                'order_items'               => $shippingItems,
                'payment_method'            => $payment_method,
                'sub_total'                 => $order->price, 
                'length'                    => $req->length, 
                'breadth'                   => $req->width, 
                'weight'                    => $req->weight, 
                'height'                    => $req->height, 
            ];
          
            $token =  Shiprocket::getToken();
         
            $response =  Shiprocket::order($token)->create($ShiprocketParams);
           
            if (isset($response['status']) && $response['status'] == 'NEW') {

                OrderItem::where('order_id', $order->id)->update([
                    'status' => 'shipment_created',
                ]);

                Shipment::where('type', 'forward')->where('order_id', $order->id)->update([
                    'delivery_date'         => TenDaysFuture(''),
                    'active'                => 1,
                    'tracking_id'           => $order->id,
                    'shiprocket_order_id'   => $response['order_id'],
                    'shipment_id'           => $response['shipment_id'],
                ]);
                    
            }

        Shipment::where('active', 0)->delete();

        return redirect()->route('admin-ship-order', $order->id);
        
    }


    public function PickupDone($order_item_id)
    {
        $OrderItem = OrderItem::with('product')->where('id', $order_item_id)->first();
        
        if (isset($OrderItem)) 
        { 
            OrderItem::where('id', $order_item_id)->update([
                'status'        => 'item_shipped',
            ]);

            $a = OrderItem::where('order_id', $OrderItem->order_id)->get();
            $b = OrderItem::where('order_id', $OrderItem->order_id)->where('status', 'item_shipped')->get();
            
            if ($a->count() == $b->count()) {
                Order::where('id', $OrderItem->order_id)->update([
                    'status' => 'order_shipped',
                ]);

                return redirect()->route('admin-ship-orders')->with(['OrderShipped' => $OrderItem->order_id]);
            } else {
                return redirect()->route('admin-ship-order', $OrderItem->order_id);
            }
        }
    }
}


