    
@extends('layouts.common')
@php 
$UserName=str_word_count(Auth()->user()->name, 1); 
@endphp
@section('title', 'Order Placed')
    
@section('content')
<div class="body-container" id="CartContainer">

    
    
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="account-details-container">
            <div class="right-wishlist-container" style="min-height: 0;">
        
                <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                    <div class="account-details-title" style="padding-bottom: 0px;">
                        <img src="{{ asset('/img/svg/gift-box.svg') }}" width="50" alt="" srcset="">
                        <span style="padding-right: 0;">{{$UserName[0]}}'s Orders</span>
                    </div>
                </div>
        
                <div class="account-menu-break"></div>   
                                                
                    <div class="wishlist-container">        
                            <div class="account-menu-break"></div>     

                            @foreach ($orders as $order)
                            
                            <div class="wishlist-basic-padding orders-header" >
                                <div class="row " style="color: black;">
                                    <div class="col-5 ">
                                        <span>Order <a style="color: #0066c0;" href="{{ route('order-page', $order->id) }}">#{{date_format($order->created_at,"Y-mdHis").'-'.$order->id}}</a></span>
                                    </div>
                                    <div class="col-3 ">
                                        <span>Order Placed: <span style="font-weight: 500;">{{date_format($order->created_at,"dS M, Y (D)")}}</span></span>
                                    </div>
                                    <div class="col-4" style="text-align: right;">
                                        <span>Total: <span style="font-weight: 500;"><font class="rupees">₹</font>{{moneyFormatIndia($order->price)}}</span>@if ($order->payment_method == 'cod') (Cash On Delivery) @elseif($order->payment_method == 'paytm') (PayTM) @elseif($order->payment_method == 'payu') (PayU) @endif</span>
                                    </div>
                                </div>
                            </div>
                            
                            @foreach ($order->OrderItems as $item)
                            <div class="wishlist-basic-padding" style="padding-bottom: 0;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="http://localhost:8000/product/{{$item->product->id}}" target="_blank">
                                            <div class="wish-product-image-container">
                                                <img src="http://localhost:8000/storage/images/products/{{$item->image->image}}" alt="">
                                            </div>
                                        </a>
                                    </div>
        
                                    <div class="col-md-5">
                                        <a href="http://localhost:8000/product/1" target="_blank">
                                            <span class="wish-product-title font-weight-500 color-0066c0">{{$item->product->product_name}}</span>
                                        </a>
                                    </div>

                                    <div class="col-3">
                                        <table style="width: 100%">
                                            <tr style="width: 100%">
                                                <td style="width: 50%">Unit Price:</td>
                                                <td style="width: 50%"><font class="rupees">₹</font>{{ moneyFormatIndia($item->unit_price) }}</td>
                                            </tr>
                                            <tr style="width: 100%">
                                                <td style="width: 50%">Qty:</td>
                                                <td style="width: 50%">{{ moneyFormatIndia($item->qty) }}</td>
                                            </tr>
                                            <tr style="width: 100%">
                                                <td style="width: 50%">Total:</td>
                                                <td style="width: 50%"><font class="rupees">₹</font>{{ moneyFormatIndia($item->total_price) }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-2">
                                        @if ($order->status == 'payment_pending') 
                                            <span style="color: #f6c23e">
                                                <span style="">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Payment Pending.
                                            </span>
                                        @elseif($order->status == 'order_placed') 
                                            <span style="color: #2874f0">
                                                <span style="">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Waiting to be shipped.
                                            </span>
                                        @elseif($order->status == 'payment_failed') 
                                            <span style="color: #ff6161">
                                                <span style="">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Payment Declined.
                                            </span>
                                        @elseif($order->status == 'order_packing') 
                                            <span style="color: #ff6161">
                                                <span style="">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Packing.
                                            </span>
                                        @endif
                                        
                                    </div>
                                </div>

                            </div>
                            <div class="row wishlist-basic-padding" style="padding-top: 0;"></div>
                                  
                            @endforeach
                            @endforeach
                        </div> 
                       
                        
                    </div>
            
                </div>
            </div>
          
            </div>
        </div>
    
    
    



</div>
@endsection

    