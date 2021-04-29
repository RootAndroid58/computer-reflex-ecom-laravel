<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function ViewOrders()
    {
        $orders = Order::with(['OrderItems.product', 'OrderItems.image'])->where('user_id', Auth()->user()->id)->where('status','!=', 'checkout_pending')->orderBy('id', 'desc')->get();
        
        return view('orders', [
            'orders' => $orders,
        ]);
    }

    public function OrderPage($order_id)
    {
        $order = Order::with('Address')->with('OrderItems')->where('id', $order_id)->first();

        if (!isset($order)) {
            abort(404);
        }
        // dd($order);
        return view('order-page', [
            'order' => $order,
        ]);
    }
}
