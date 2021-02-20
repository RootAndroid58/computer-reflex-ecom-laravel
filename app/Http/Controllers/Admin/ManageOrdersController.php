<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipment;
use DateTime;

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

    public function ShipOrder ($order_id)
    {
        $order = Order::with(['OrderItems', 'Address'])->where('id', $order_id)->first();

        if ($order->status == 'order_placed') {
            return view('admin.shipping.mark-as-packing',[
                'order' => $order,
            ]);
        }
        elseif ($order->status == 'order_packing') {
            return view('admin.shipping.pack-order', [
                'order' => $order,
            ]);
        }
        elseif ($order->status == 'packing_completed') {
            return view('admin.shipping.create-order-shipment', [
                'order' => $order,
            ]);
        }
        elseif ($order->status == 'shipment_created') {
            return view('admin.shipping.shipment-pickup', [
                'order' => $order,
            ]);
        }
    }

    public function StartPacking(Request $req)
    {
        $req->validate([
            'order_id' => 'required'
        ]);

        $order = Order::where('id', $req->order_id)->first();

        if ($order->status == 'order_placed') {
            Order::where('id', $req->order_id)->update([
                'status' => 'order_packing',
            ]);

            return redirect()->route('admin-ship-order', $req->order_id);
        }
    }

    public function CompletePacking(Request $req)
    {
        $order = Order::where('id', $req->order_id)->first();

        if ($order->status == 'order_packing') {
            Order::where('id', $req->order_id)->update([
                'status' => 'packing_completed',
            ]);

            return redirect()->route('admin-ship-order', $req->order_id);
        }
    }

    public function CreateShipping(Request $req)
    {
        
        $req->validate([
            'courier_name'      => 'required',
            'tracking_id'       => 'required',
            'delivery_date'     => 'required',
            'order_id'          => 'required',
        ]);

        $order = Order::where('id', $req->order_id)->first();

        if ($order->status == 'packing_completed') 
        {
            $shipment = new Shipment;
            $shipment->order_id = $req->order_id;
            $shipment->courier_name = $req->courier_name;
            $shipment->tracking_id = $req->tracking_id;
            $shipment->save();

            Order::where('id', $req->order_id)->update([
                'delivery_date' => new DateTime($req->delivery_date),
                'status'        => 'shipment_created',
            ]);
    
            return redirect()->route('admin-ship-order', $req->order_id);
        } 

        
    }

    public function PickupDone(Request $req)
    {
        $order = Order::where('id', $req->order_id)->first();
        
        if ($order->status == 'shipment_created') 
        { 
            Order::where('id', $req->order_id)->update([
                'status'        => 'order_shipped',
            ]);
            
            return redirect()->route('admin-ship-orders')->with(['OrderShipped' => $req->order_id]);
        }
    }
}
