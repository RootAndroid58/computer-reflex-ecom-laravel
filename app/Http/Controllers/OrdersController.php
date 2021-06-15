<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCancelRequest;

class OrdersController extends Controller
{
    public function ViewOrders()
    {
        $orders = Order::with(['OrderItems.product', 'OrderItems.image'])->where('user_id', Auth()->user()->id)->where('status','!=', 'checkout_pending')->orderBy('id', 'desc')->paginate(10);
        
        return view('orders', [
            'orders' => $orders,
        ]);
    }

    public function OrderPage($order_id)
    {
        $order = Order::with('Address')->with('PendingCancelRequest')->with('CancelRequest')->with('OrderItems.OrderItemLicenses.ProductLicense')->with('OrderItems.shipment')->where('id', $order_id)->where('user_id', Auth()->user()->id)->first();

        if (!isset($order)) {
            abort(404);
        }
        // dd($order);
        return view('order-page', [
            'order' => $order,
        ]);
    }

    public function CancelRequest(Request $req)
    {
        $req->validate([
            'reason'    => 'required',
            'order_id'  => 'required',
        ]);

        $order = Order::with('PendingCancelRequest')->where('id', $req->order_id)->where('user_id', Auth()->user()->id)->first();
           
        if (!isset($order) || isset($order->PendingCancelRequest) || $order->delivery_type == 'electronic') {
            abort(500);
        }

        $CancelReq = new OrderCancelRequest;
        $CancelReq->order_id = $order->id;
        $CancelReq->reason = $req->reason;
        $CancelReq->status = 'requested';
        $CancelReq->save();

        return redirect()->back();
        
    }
}
