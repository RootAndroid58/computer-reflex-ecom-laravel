<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\OrderItem;
use DateTime;

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

    public function ShipOrder ($order_id)
    {
        $order = Order::with('OrderItems')->where('id', $order_id)->first();

        if (isset($order) && $order->status == 'order_placed') {
            return view('admin.shipping.process-order',[
                'order' => $order,
            ]);
        } else {
            abort(500);
        }
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



    public function CreateShipment(Request $req)
    {
        $req->validate([
            'order_item_ids' => 'required',
        ]);

        $order = Order::with('OrderItems')->with('address')->where('id', $req->order_id)->first();
        $orderItems = OrderItem::whereIn('id', $req->order_item_ids)->where('status', 'packing_completed')->get();
        // dd($req);

        if ($orderItems->count() < 1) {
            abort(500);
        }
        return view('admin.shipping.create-shipment', [
            'order'         => $order,
            'orderItems'    => $orderItems,
        ]);
    }


    public function CreateShipmentSubmit(Request $req)
    {
        
        $req->validate([
            'order_id'      => 'required|exists:orders,id',
            'order_item_ids'=> 'required|exists:order_items,id',
            'buyer_name'    => 'required',
            'house_no'      => 'required',
            'locality'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'state'         => 'required',
            'pin_code'      => 'required',
            'mobile'        => 'required',
            'alt_mobile'    => 'nullable',
            'length'        => 'required',
            'height'        => 'required',
            'weight'        => 'required',
        ]);
            

        $order = Order::with('Address')->with('User')->where('id', $req->order_id)->first();
        
        if ($order->status == 'cod') { 
            $payment_method = "COD";
        } else { 
            $payment_method = "Prepaid";
        }

        $TotalPackagePrice = 0;

        foreach ($req->order_item_ids as $key => $order_item_id) {
            
            $shipmentCheck = Shipment::where('order_item_id', $order_item_id)->where('active', 1)->first();
            
            if (isset($shipmentCheck)) {
                abort(500);
            }

            $OrderItem = OrderItem::with('product')->where('id', $order_item_id)->first();
            
            $TotalPackagePrice = $TotalPackagePrice + $OrderItem->unit_price;
            
            $shipment = new Shipment;
            $shipment->order_item_id = $order_item_id;
            $shipment->courier_name = 'Shiprocket';
            $shipment->tracking_id = 'Not Available';
            $shipment->active = 0;
            $shipment->save();

            $shippingItems[] = [
                'name'          => $OrderItem->product->product_name, 
                'sku'           => $OrderItem->product->id, 
                'units'         => $OrderItem->qty, 
                'selling_price' => $OrderItem->total_price, 
                'discount'      => $OrderItem->unit_mrp - $OrderItem->unit_price, 
            ];
        }
       
        $ShiprocketParams = [
            'order_id'                  => $shipment->id,
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
            'billing_alternate_phone'   => $order->Address->alt_mobile,
            'shipping_is_billing'       => true,
            'order_items'               => $shippingItems,
            'payment_method'            => $payment_method,
            'sub_total'                 => $TotalPackagePrice, 
            'length'                    => $req->length, 
            'breadth'                   => $req->width, 
            'weight'                    => $req->weight, 
            'height'                    => $req->height, 
        ];
        

        $token =  Shiprocket::getToken();
        $response =  Shiprocket::order($token)->create($ShiprocketParams);
    
        if ($response['status'] == 'NEW') {
            
            foreach ($req->order_item_ids as $key => $value) {

                OrderItem::where('id', $value)->update([
                    'status' => 'shipment_created',
                ]);

                Shipment::where('order_item_id', $value)->update([
                    'active'        => 1,
                    'tracking_id'   => $shipment->id,
                    'shipment_id'   => $response['shipment_id'],
                ]);
            }
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
