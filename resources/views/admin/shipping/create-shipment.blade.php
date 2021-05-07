@extends('layouts.panel')

@section('title', 'Create Shipment')

@section('nav-manage-orders', 'active')

@section('css-js')
    
@endsection


@section('modals')

@endsection



@section('content')
<div class="container-fluid">
    <h3>Create Shipment</h3>
</div>




<form action="{{ route('admin-create-shipment-submit') }}" method="post" class="w-100"> @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="account-details-container">
            <div class="right-wishlist-container" style="min-height: 0;">
        
                <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                    <div class="account-details-title" style="padding-bottom: 0px;">
                        <img src="{{ asset('/img/svg/packages.svg') }}" width="50" alt="" srcset="">
                        <span style="padding-right: 0;"><font style="font-weight: 600; color: black;">Process Order</font></span> #{{ date_format($order->created_at,"Y-mdHis").'-'.$order->id }}
                    </div>
                </div>
        
                <div class="account-menu-break"></div>   
                                                    
                    <div class="wishlist-container ">   
        
                            <div class="account-menu-break"></div>     
                                
                                <div class="wishlist-basic-padding">
                                    <div class="order-confirmation-notes">
                                        <span>Order ID: <span style="font-weight: 600; color: black;">{{ $order->id }}</span></span><br>
                                        <span>Order Date: <span style="font-weight: 600; color: black;">{{ $order->created_at }}</span></span><br>
                                        <span>Status: 
                                            @if($order->status == 'order_placed') 
                                            <span style="color: #2874f0">
                                                <span style="">
                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                </span>
                                                Order Placed.
                                            </span>
                                        @endif
                                        </span>
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
                                        <div class="form-group">
                                            <label for="">Buyer Name</label>
                                            <input type="text" name="buyer_name" value="{{ $order->address->name ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="">House No. / Apt.</label>
                                            <input type="text" name="house_no" value="{{ $order->address->house_no ?? '' }}"  id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Locality</label>
                                            <input type="text" name="locality" value="{{ $order->address->locality ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="">City/Town</label>
                                            <input type="text" name="city" value="{{ $order->address->city ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">District </label>
                                            <input type="text" name="district" value="{{ $order->address->district ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="">State  </label>
                                            <input type="text" name="state" value="{{ $order->address->state ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Postal PIN Code</label>
                                            <input type="text" name="pin_code" value="{{ $order->address->pin_code ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="">Mobile Number</label>
                                            <input type="text" name="mobile" value="{{ $order->address->mobile ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Alternate Mobile</label>
                                            <input type="text" name="alt_mobile" value="{{ $order->address->alt_mobile ?? '' }}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
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
                        <span style="font-weight: 600; color: black;">Shipment Contents ({{ $orderItems->count() }})</span>
                    </div>
                </div>
        
                <div class="account-menu-break"></div>   
                                                    
                    <div class="wishlist-container">   
                        @foreach ($orderItems as $item)
                            <input type="hidden" name="order_item_ids[]" value="{{$item->id}}">
                            <div class="account-menu-break"></div>     
                                <div class="row wishlist-basic-padding" style="padding-bottom: 0;">
                                    <div class="col-md-3">
                                        <a href="{{route('product-index', $item->product_id)}}" target="_blank">
                                            <div class="wish-product-image-container">
                                                <img src="{{asset('storage/images/products/'.$item->image->image)}}" alt="">
                                            </div>
                                        </a>
                                    </div>
        
                                    <div class="col-md-8">
                                        <a href="{{route('product-index', $item->product_id)}}" target="_blank">
                                            <span class="wish-product-title font-weight-500 color-0066c0">{{$item->product->product_name}}</span>
                                        </a>
                                        <p>
                                            <div class="details-price" style="margin-bottom: 0;">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <span style="font-weight: normal; font-size: 15px;">Unit Price: <span style="font-weight: 500;"><font class="rupees">₹</font> {{moneyFormatIndia($item->unit_price)}}</span></span><br>
                                                            <span style="font-weight: normal; font-size: 15px;">Qty: <span style="font-weight: 500;"> {{$item->qty}}</span></span><br>
                                                            <span style="font-weight: normal; font-size: 15px;">Total Price: <span style="font-weight: 500;"><font class="rupees">₹</font> {{moneyFormatIndia($item->total_price)}}</span></span><br>

                                                            
                                                        </div>

                                                        <div class="col-5" style="text-align: right;">
                                                            @if ($item->status == 'order_placed')
                                                                <a data-toggle="modal" data-target="#StartPackingModal{{$item->id}}" class="btn btn-dark">START PACKING</a>
                                                            @elseif($item->status == 'packing_started')
                                                                <a data-toggle="modal" data-target="#PackingCompletedModal{{$item->id}}" class="btn btn-dark">PACKING COMPLETED</a>
                                                            @elseif($item->status == 'packing_completed')
                                                                {{-- <a href="{{ route('admin-create-shipment-view', $item->id) }}" class="btn btn-dark">CREATE SHIPMENT</a> --}}
                                                            
                                                            @endif
                                                        </div>

                                                        
                                                    </div>
                                                    
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


        <div class="container ">
            <div class="wishlist-basic-padding account-details-container">
                
                <div class="row mb-3" style="color: rgb(70, 70, 70); font-weight: 600;">
                                                                
                    <div class="form-group col-3">
                        <label for="">Length</label>
                        <div class="input-group">
                            <input required type="text" name="length" placeholder="Length" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1">CM</span>
                            </div>
                        </div>
                    </div>
                
                
                    <div class="form-group col-3">
                        <label for="">Width</label>
                        <div class="input-group">
                            <input required type="text" name="width" placeholder="Width" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1">CM</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group col-3">
                        <label for="">Height</label>
                        <div class="input-group">
                            <input required type="text" name="height" placeholder="Height" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1">CM</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group col-3">
                        <label for="">Weight</label>
                        <div class="input-group">
                            <input required type="text" name="weight" placeholder="Weight"  id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1">KG</span>
                            </div>
                        </div>
                    </div>
                
            </div>

                <button class="btn btn-block btn-dark" type="submit">
                    Create Shipment Order With Courier
                </button>
            </div>
        </div>






</form>


        








@endsection