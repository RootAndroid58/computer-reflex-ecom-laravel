@extends('layouts.panel')

@section('title', 'Process Order')

@section('nav-manage-orders', 'active')

@section('modals')

    <!-- Modal -->
    <div class="modal fade" id="CreateShipmentModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin-create-shipment') }}" method="post" class="w-100"> @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Create Shipment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    @foreach ($order->OrderItems as $item)
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
                                                    @endif
                                                </div>

                                                <div class="col-5" >
                                                    @if ($item->status == 'packing_completed')
                                                        <div class="form-check">
                                                          <label class="form-check-label cursor-pointer">
                                                            <input type="checkbox" class="form-check-input cursor-pointer" name="order_item_ids[]" id="" value="{{$item->id}}">
                                                                Add To The Shipment
                                                          </label>
                                                        </div>
                                                    @else
                                                        <span class="text-danger text-left">Complete the packaging to add this item to a shipment.</span>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    @foreach ($order->OrderItems as $item)
    <div class="modal fade" id="StartPackingModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Start Packing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to start the packaging of <br>
                    <b>{{ $item->product->product_name }}</b>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('admin-start-packing-order', $item->id) }}" class="btn btn-success">Yes, Start Packing.</a>
                </div>
            </div>
        </div>
    </div> 
    @endforeach


    <!-- Modal -->
    @foreach ($order->OrderItems as $item)
    <div class="modal fade" id="PackingCompletedModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Packing Completed</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure, that packing completed for <br>
                    <b>{{ $item->product->product_name }}</b>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('admin-complete-packing-order', $item->id) }}" class="btn btn-success">Yes, Packing Completed.</a>
                </div>
            </div>
        </div>
    </div> 
    @endforeach

@endsection




@section('content')


<div class="container-fluid">

    <h3>Ship Order</h3>

</div>

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
                                                            @endif
                                                        </div>

                                                        <div class="col-5" style="text-align: right;">
                                                            @if ($item->status == 'order_placed')
                                                                <a data-toggle="modal" data-target="#StartPackingModal{{$item->id}}" class="btn btn-dark">START PACKING</a>
                                                            @elseif($item->status == 'packing_started')
                                                                <a data-toggle="modal" data-target="#PackingCompletedModal{{$item->id}}" class="btn btn-dark">PACKING COMPLETED</a>
                                                            @elseif($item->status == 'packing_completed')
                                                                {{-- <a href="{{ route('admin-create-shipment-view', $item->id) }}" class="btn btn-dark">CREATE SHIPMENT</a> --}}
                                                            @elseif($item->status == 'shipment_created')
                                                                <a href="{{ route('admin-order-pickup-done', $item->id) }}" class="btn btn-dark">PICKUP COMPLETED</a>
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












        
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="account-details-container">
                    <div class="right-wishlist-container" style="min-height: unset;">             
                        
                        <div class="wishlist-basic-padding">
                            <div class="account-details-title" style="padding-bottom: 0px;">
                                <span style="font-weight: 600; color: black;">Create Shipment</span>
                            </div>
                        </div>

                        <div class="wishlist-basic-padding" style="padding-top: 0;">
                            <button class="btn btn-block btn-dark" data-toggle="modal" data-target="#CreateShipmentModal">Create Shipment</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection