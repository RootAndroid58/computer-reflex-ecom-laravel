@if (isMobile())

@include('mobile.checkout.failed')

{{ die }}
@endif


@extends('layouts.common')

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
                        <img src="{{ asset('/img/svg/sad.svg') }}" width="50" alt="" srcset="">
                        <span style="padding-right: 0; color: #e74a3b;">Order Failed (Payment Declined)</span> #{{ date_format($data['order']->created_at,"Y-mdHis").'-'.$data['order']->id }}
                    </div>
                </div>
        
                <div class="account-menu-break"></div>   
                                                    
                    <div class="wishlist-container">   
                
    
                            <div class="account-menu-break"></div>     
                                <div class="wishlist-basic-padding" id="CartItem2" style="padding-bottom: 0;">
                                    <div class="order-confirmation-notes">
                                        <span>As per the data received from the Payment Gateway (@if ($data['order']->payment_method == 'paytm') PayTM @elseif($data['order']->payment_method == 'payu') PayU @endif)<br> It looks like the Payment was declined by user or bank.</span><br>
                                        <span>If any amount deducted from your account, please <a href="#">contact us</a> so that we can help you get your refund as soon as possible.</span><br>
                                        <span>Sorry for the inconvenience, you may place a <a href="{{url('/')}}">new order.</a></span>
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
        <div class="right-wishlist-container" style="min-height: 0;">
    
            <div class="wishlist-basic-padding">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col-6">
                            <span>Delivery Address</span>
                        </div>
                        <div class="col-6">
                            <span>Order Summary</span>
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
                                        <span style="font-weight: 500;">{{$data['address']->name}}</span> <br>
                                        {{$data['address']->house_no}}, <br>
                                        {{$data['address']->locality}}, <br>
                                        {{$data['address']->city}}, <br>
                                        {{$data['address']->district}}, <br>
                                        {{$data['address']->state}}, {{$data['address']->pin_code}} <br>
                                    </p>
                                    <p>
                                        <span style="font-weight: 500;">Contact information</span><br>
                                        {{$data['address']->mobile}}@if (isset($data['address']->alt_mobile)), {{$data['address']->alt_mobile}}@endif
                                        
                                    </p>
                                </div>

                                <div class="col-6">
                                    <table style="width: 100%;">
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Payment Method:</td>    
                                            <td style="width: 50%; text-align: right;">@if ($data['order']->payment_method == 'cod') Cash On Delivery @elseif($data['order']->payment_method == 'paytm') PayTM @elseif($data['order']->payment_method == 'payu') PayU @elseif($data['order']->payment_method == 'voucher') Voucher @endif</td>    
                                        </tr>    
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Items List:</td>    
                                            <td style="width: 50%; text-align: right;">{{ $data['items']->count() }}</td>    
                                        </tr>    
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Order MRP:</td>    
                                            <td style="width: 50%; text-align: right;"><font class="rupees">₹</font>{{ moneyFormatIndia($data['order']->mrp) }}</td>    
                                        </tr>    
                                        <tr style="width: 100%">
                                            <td style="width: 50%; font-weight: 500;">Discount:</td>    
                                            <td style="width: 50%; text-align: right; color: #388e3c;">-<font class="rupees">₹</font>{{ moneyFormatIndia($data['order']->mrp - $data['order']->price) }}</td>    
                                        </tr>    
                                        <tr style="width: 100%; font-size: 16px; ">
                                            <td style="width: 50%; font-weight: 500; padding-top: 10px;">Grand Total:</td>    
                                            <td style="width: 50%; font-weight: 500; color: black; text-align: right; padding-top: 10px;"><font class="rupees">₹</font>{{ moneyFormatIndia($data['order']->price) }}</td>    
                                        </tr>   
                                       
                                    </table>
        
                                    @if ($data['order']->payment_method != 'cod')
                                    <div style="padding-top: 10px; text-align: right;">
                                        <span style="font-size: 16px; color: #e74a3b;">
                                            Payment Failed <i class="fa fa-times" aria-hidden="true"></i>
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
                    <span>Items Ordered ({{ $data['items']->count() }})</span>
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container">   
                    @foreach ($data['items'] as $item)
                  
                        <div class="account-menu-break"></div>     
                            <div class="row wishlist-basic-padding" style="padding-bottom: 0;">
                                <div class="col-md-3">
                                    <a href="{{ route('product-index', $item->product_id) }}" target="_blank">
                                        <div class="wish-product-image-container">
                                            <img src="{{ asset('storage/images/products/'.$item->image->image) }}" alt="">
                                        </div>
                                    </a>
                                </div>
    
                                <div class="col-md-8">
                                    <a href="{{ route('product-index', $item->product_id) }}" target="_blank">
                                        <span class="wish-product-title font-weight-500 color-0066c0">{{$item->product->product_name}}</span>
                                    </a>
                                    <p>
                                        <div class="details-price" style="margin-bottom: 0;">
                                                <span style="font-weight: normal; font-size: 15px;">Unit Price: <span style="font-weight: 500;"><font class="rupees">₹</font> {{moneyFormatIndia($item->unit_price)}}</span></span><br>
                                                <span style="font-weight: normal; font-size: 15px;">Qty: <span style="font-weight: 500;"> {{$item->qty}}</span></span><br>
                                                <span style="font-weight: normal; font-size: 15px;">Total Price: <span style="font-weight: 500;"><font class="rupees">₹</font> {{moneyFormatIndia($item->total_price)}}</span></span><br>
                                                <span style="font-weight: normal; font-size: 15px; color: #e74a3b;">Order Failed.</span>
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







</div>
@endsection