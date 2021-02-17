@extends('layouts.panel')

@section('title', 'Start Packing')

@section('nav-manage-orders', 'active')

@section('css-js')
    
@endsection

@section('content')
<div class="container-fluid">

    <h3>Start Packing</h3>

</div>



<div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="account-details-container">
        <div class="right-wishlist-container" style="min-height: 0;">
    
            <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <img src="{{ asset('/img/svg/packages.svg') }}" width="50" alt="" srcset="">
                    <span style="padding-right: 0;"><font style="font-weight: 600; color: black;">Start Packing</font></span> #{{ date_format($order->created_at,"Y-mdHis").'-'.$order->id }}
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container ">   
    
                        <div class="account-menu-break"></div>     
                            
                            <div class="wishlist-basic-padding" style="padding-bottom: 0;">
                                <div class="order-confirmation-notes">
                                    <span>Before shipping the order you have to pack the order properly.</span><br>
                                    <span>To start packing and print all labels click the below <span style="color: black; font-weight: 600;">"Start Packing"</span> button.</span><br>
                                    <span>After clicking the button the order status will be updated to <span style="color: black; font-weight: 600;">"Packing"</span>.</span>
                                </div>
                            </div>
                            <div class="wishlist-basic-padding" style="padding-bottom: 0;">
                                <div class="order-confirmation-notes">
                                    <span>Order ID: <span style="font-weight: 600; color: black;">{{ $order->id }}</span></span><br>
                                    <span>Order Date: <span style="font-weight: 600; color: black;">{{ $order->created_at }}</span></span><br>
                                    <span>Delivery By: <span style="font-weight: 600; color: black;">{{date_format($order->created_at->modify( '+10 days' ), "dS M, Y (D)")}}</span></span><br>
                                </div>
                            </div>
                            
                            
                            <div class="wishlist-basic-padding" >
                                <div class="btn-container" >
                                    <form action="{{ route('admin-start-packing-order') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-dark">START PACKING</button>
                                    </form> 
                                </div>
                            </div>

                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>









<div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="account-details-container">
        <div class="right-wishlist-container" style="min-height: 0;">
    
            <div class="wishlist-basic-padding">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col-6">
                            <span style="font-weight: 600; color: black;">Delivery Address</span>
                        </div>
                        <div class="col-6">
                            <span style="font-weight: 600; color: black;">Order Summary</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container">                                            

                        <div class="account-menu-break"></div>     
                         
                            <div class="row wishlist-basic-padding" id="CartItem2" style="padding-bottom: 0;">

                                <div class="col-6">
                                    <p>
                                        <span style="font-weight: 500;">{{$order->Address->name}}</span> <br>
                                        {{$order->Address->house_no}}, <br>
                                        {{$order->Address->locality}}, <br>
                                        {{$order->Address->city}}, <br>
                                        {{$order->Address->district}}, <br>
                                        {{$order->Address->state}}, {{$order->Address->pin_code}} <br>
                                    </p>
                                    <p>
                                        <span style="font-weight: 500;">Contact information</span><br>
                                        {{$order->Address->mobile}}@if (isset($order->Address->alt_mobile)), {{$order->Address->alt_mobile}}@endif
                                        
                                    </p>
                                </div>

                                <div class="col-6">
                                    <table style="width: 100%;">
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Payment Method:</td>    
                                            <td style="width: 50%; text-align: right;">@if ($order->payment_method == 'cod') Cash On Delivery @elseif($order->payment_method == 'paytm') PayTM @elseif($order->payment_method == 'payu') PayU @endif</td>    
                                        </tr>    
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Items Ordered:</td>    
                                            <td style="width: 50%; text-align: right;">{{ $order->OrderItems->count() }}</td>    
                                        </tr>    
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Order MRP:</td>    
                                            <td style="width: 50%; text-align: right;"><font class="rupees">₹</font>{{ moneyFormatIndia($order->mrp) }}</td>    
                                        </tr>    
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Discount:</td>    
                                            <td style="width: 50%; text-align: right; color: #388e3c;">-<font class="rupees">₹</font>{{ moneyFormatIndia($order->mrp - $order->price) }}</td>    
                                        </tr>    
                                        <tr style="width: 100%; font-size: 16px; ">
                                            <td style="width: 50%; font-weight: 500; padding-top: 10px;">Grand Total:</td>    
                                            <td style="width: 50%; font-weight: 500; color: black; text-align: right; padding-top: 10px;"><font class="rupees">₹</font>{{ moneyFormatIndia($order->price) }}</td>    
                                        </tr>   
                                       
                                    </table>
        
                                    @if ($order->payment_method != 'cod')
                                    <div style="padding-top: 10px; text-align: right;">
                                        <span style="font-size: 16px; color: #388e3c;">
                                            Payment Completed <i class="fa fa-check" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @endif
                                                                   
                                </div>
                                
                            </div>

                            <div class="row wishlist-basic-padding" style="padding-top: 0;"></div>

                        <div class="account-menu-break" id="CartBreak2"></div>      
                         
                    </div> 
                    
                </div>
        
            </div>
        </div>
      
        </div>
    </div>









    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="account-details-container">
            <div class="right-wishlist-container" style="min-height: unset;">
        
                <div class="wishlist-basic-padding">
                    <div class="account-details-title" style="padding-bottom: 0px;">
                        <span style="font-weight: 600; color: black;">Items Ordered ({{ $order->OrderItems->count() }})</span>
                    </div>
                </div>
        
                <div class="account-menu-break"></div>   
                                                    
                    <div class="wishlist-container">   
                        @foreach ($order->OrderItems as $item)
                     
                            <div class="account-menu-break"></div>     
                                <div class="row wishlist-basic-padding" style="padding-bottom: 0;">
                                    <div class="col-md-3">
                                        <a href="http://localhost:8000/product/{{$item->product_id}}" target="_blank">
                                            <div class="wish-product-image-container">
                                                <img src="http://localhost:8000/storage/images/products/{{$item->image->image}}" alt="">
                                            </div>
                                        </a>
                                    </div>
        
                                    <div class="col-md-8">
                                        <a href="http://localhost:8000/product/{{$item->product_id}}" target="_blank">
                                            <span class="wish-product-title font-weight-500 color-0066c0">{{$item->product->product_name}}</span>
                                        </a>
                                        <p>
                                            <div class="details-price" style="margin-bottom: 0;">
                                                    <span style="font-weight: normal; font-size: 15px;">Unit Price: <span style="font-weight: 500;"><font class="rupees">₹</font> {{moneyFormatIndia($item->unit_price)}}</span></span><br>
                                                    <span style="font-weight: normal; font-size: 15px;">Qty: <span style="font-weight: 500;"> {{$item->qty}}</span></span><br>
                                                    <span style="font-weight: normal; font-size: 15px;">Total Price: <span style="font-weight: 500;"><font class="rupees">₹</font> {{moneyFormatIndia($item->total_price)}}</span></span>
                                                
                                            </div>
                                        </p>
                                    </div>
    
                                </div>
    
                                <div class="row wishlist-basic-padding" style="padding-top: 0;"></div>
    
                            <div class="account-menu-break" id="CartBreak2"></div>      
               
                            @endforeach
                        </div> 
                        
                    </div>
            
                </div>
            </div>
          
            </div>
        </div>
    


@endsection


@section('bottom-js')

@endsection