@extends('layouts.mobile-common')

@section('title', 'My Orders')

@section('burger-my-orders-menu', 'account-menu-item-active')

@section('content')
<div class="container-fluid">
    <div class="mt-3 mb-3 d-flex align-items-center">
        <div class="mr-2"><img src="{{ asset('/img/svg/gift-box.svg') }}" width="40px" height="40px" alt=""></div>
        <div><span style="font-size: 16px; font-weight: 500;">My Orders</span></div>
    </div>
</div>

<div class="account-menu-break"></div>







@foreach ($orders as $order) 
<div class="container-fluid " style="background-color: #f1f1f1;">
    <div class="pt-2 pb-2"  style="font-weight: 600;">
        <span>Order #</span> 
        <span class="static-blue"><a class="static-blue" href="{{ route('order-page', $order->id) }}">{{date_format($order->created_at,"Y-mdHis").'-'.$order->id}}</a></span> 
    </div>
    <div class="pb-2" style="font-weight: 600;">
        @if ($order->status == 'payment_pending') 
            <span style="color: #f6c23e">
                (Payment Pending.)
            </span>
        @elseif($order->status == 'order_placed') 
            <span style="color: #2874f0">
                (Order Placed.)
            </span>
        @elseif($order->status == 'payment_failed') 
            <span style="color: #ff6161">
                (Payment Declined.)
            </span>
        @endif
    </div>
</div>

<div class="account-menu-break"></div>
    
    @foreach ($order->OrderItems as $item)
    <div class="container-fluid pt-3 pb-3">
        <a href="{{ route('order-page', $order->id) }}">
            <div class="row">
                <div class="col-3">
                    <img style="width: 100%; max-height: 100%;" src="{{ asset('storage/images/products/'.$item->image->image) }}" alt="">
                </div>
                <div class="col-9" style="padding-left: 0;">
                    <span class="line-limit-2">{{ $item->product->product_name }}</span>
                    <div>
                        @if ($item->status == 'order_placed')
                        <span style="color: #2874f0">
                            <span style="">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </span>
                            Order Placed.
                        </span>
                        @elseif($item->status == 'packing_started')
                        <span style="color: #2874f0">
                            <span style="">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </span>
                            Packing Started.
                        </span>
                        @elseif($item->status == 'packing_completed')
                        <span style="color: #2874f0">
                            <span style="">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </span>
                            Packing Completed.
                        </span>
                        @elseif($item->status == 'shipment_created')
                        <span style="color: #2874f0">
                            <span style="">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </span>
                            Shipment Created, Waiting For Pickup.
                        </span>
                        @elseif($item->status == 'item_shipped')
                        <span style="color: #2874f0">
                            <span style="">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </span>
                            Product Shipped Via <b>{{ $item->shipment->courier_name }}</b>.<br>
                            
                                Delivery By: <b>{{date_format(new DateTime($item->shipment->delivery_date), "dS M,(D)")}}</b>
                        
                        </span>
                        @elseif($item->status == 'item_delivered')
                        <span style="color: #28a745">
                            <span style="">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </span>
                            Delivered On: <b>{{date_format(new DateTime($item->shipment->delivery_date), "dS M,(D)")}}</b>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="account-menu-break"></div>
    @endforeach
    
@endforeach



@endsection

