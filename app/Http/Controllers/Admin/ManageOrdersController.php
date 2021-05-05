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

    public function CreateShipmentSubmit(Request $req)
    {
        $req->validate([
            'order_id'      => 'required|exists:orders,id',
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
  

        foreach ($req->length as $key => $length) {
            $OrderItem = OrderItem::where('id', $key)->first();
            
            Product::where('id', $OrderItem->product_id)->update([
                'length' => $req->length[$key],
                'height' => $req->height[$key],
                'weight' => $req->weight[$key],
            ]);
        }

        $ShiprocketParams = [
            'order_id' => $req->order_id,
        ];

        $token =  Shiprocket::getToken();

        dd($token);

        $response =  Shiprocket::order($token)->create($ShiprocketParams);
        

        dd($response);
    }

    public function CreateShipment(Request $req)
    {
        $req->validate([
            'order_item_ids' => 'required',
        ]);

        $order = Order::with('OrderItems')->with('address')->where('id', $req->order_id)->first();
        $orderItems = OrderItem::whereIn('id', $req->order_item_ids)->get();
        // dd($req);

        return view('admin.shipping.create-shipment', [
            'order'         => $order,
            'orderItems'    => $orderItems,
        ]);
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
