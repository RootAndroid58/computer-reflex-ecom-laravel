<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ManageOrdersController extends Controller
{
    public function ViewManageOrders()
    {
        return view('admin.manage-orders');
    }

    public function ShipOrdersPage()
    {
        return view('admin.ship-orders');
    }

    public function ShipOrder ($order_id)
    {
        $order = Order::with(['OrderItems', 'Address'])->where('id', $order_id)->first();

        if ($order->status == 'order_placed') {
            return view('admin.mark-as-packing',[
                'order' => $order,
            ]);
        }
        elseif ($order->status == 'order_packing') {
            return view('admin.pack-order', [
                'order' => $order,
            ]);
        }
        elseif ($order->status == 'packing_completed') {
            return view('admin.create-order-shipment', [
                'order' => $order,
            ]);
        }
    }

    public function StartPacking(Request $req)
    {
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
}
