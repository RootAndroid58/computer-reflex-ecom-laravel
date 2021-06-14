@extends('layouts.panel')

@section('title', 'Manage Order')

@section('nav-manage-orders', 'active')

@section('modals')

    <!-- Modal -->
    @if (isset($order->PendingCancelRequest))
    <form action="{{ route('admin-cancel-review-submit') }}" method="post"> @csrf <input type="hidden" name="order_id" value="{{ $order->id }}">
    <div class="modal fade" id="CancelReqRespondModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header "> 
                    <h5 class="modal-title">Review Cancel Request #{{ $order->PendingCancelRequest->id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">
                    <div class="form-check">
                        <label class="form-check-label cursor-pointer">
                        <input required type="radio" class="form-check-input cursor-pointer" name="cancel_review" id="approve" value="approve">
                        Approve (Cancel The Order)
                      </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label cursor-pointer">
                        <input required type="radio" class="form-check-input cursor-pointer" name="cancel_review" id="decline" value="decline">
                        Decline
                      </label>
                    </div>

                    <div class="form-group mt-4 reviewComment d-none">
                      <label for="review_comment">Why rejecting the cancellation request?</label>
                      <textarea class="form-control" name="review_comment" id="review_comment" rows="3" placeholder="Rejection Reason..." ></textarea>
                    </div>

                    @if ($order->payment_method == 'paytm' || $order->payment_method == 'payu')
                    <div class="reviewRefund d-none mt-4 alert alert-info">
                        <span>
                            On order cancellation Full Refund of 
                            <span class="text-primary"><font class="rupees">₹</font>{{ moneyFormatIndia($order->price) }}</span>
                            will be Initiated via ({{ $order->payment_method }}). 
                        </span>
                    </div>

                    <p class="mt-4 reviewRefund d-none">
                        <span class="font-weight-bold">Note: </span>if somehow the refund fails, a refund requested will be created for this order.
                        <br>
                        The most common cause of refund fail is Insufficient balance on PG wallet.
                    </p>
                    @endif
                    

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>     
    @endif


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
    <h3>Manage Order</h3>
</div>

<div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="account-details-container">
        <div class="right-wishlist-container" style="min-height: 0;">
    
            <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <img src="{{ asset('/img/svg/packages.svg') }}" width="50" alt="" srcset="">
                    <span style="padding-right: 0;"><font style="font-weight: 600; color: black;">Manage Order</font></span> #{{ date_format($order->created_at,"Y-mdHis").'-'.$order->id }}
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
                                    @elseif($order->status == 'order_cancelled') 
                                        <span class="text-danger">
                                            <span style="">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </span>
                                            Order Cancelled.
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





                @if ($order->CancelRequest->count() > 0)
                <div class="container">
                    <div class="account-details-container">
                        <div class="wishlist-basic-padding" style="padding-bottom: 0;">
                            @foreach ($order->CancelRequest as $cancelReq)
                                <div class="collapse-item mb-4">
                                    <div class="collapse-btn" style="padding: 7px 10px; transition: all 200ms; background-color: rgba(212, 212, 212, 0.781);">
                                        <span style="font-weight: 600">Cancel Request #{{ $cancelReq->id }} - 
                                            @if ($cancelReq->status == 'requested')
                                            <span class="btn btn-sm btn-warning">Requested</span>
                                            @elseif ($cancelReq->status == 'approved')
                                            <span class="btn btn-sm btn-success">Approved</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="collapse-content bg-light" style="">
                                        <div style="padding-top: 6px; padding-bottom: 6px;">
                                            <p>
                                                @if ($cancelReq->status == 'requested')
                                                    <span>
                                                        <span style="font-weight: 700;">Reason:</span>
                                                        {{ $cancelReq->reason }}
                                                    </span>
                                                @endif
                                                @if ($cancelReq->status == 'approved')
                                                    <span>
                                                        Approved and order cancelled.
                                                    </span>
                                                @endif
                                            </p>
                                            @if ($cancelReq->status == 'requested')
                                            <div>
                                                <button class="btn btn-dark btn-block" type="button" data-target="#CancelReqRespondModal" data-toggle="modal">Respond To The Request</button>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="account-menu-break"></div>  
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="account-menu-break"></div> 
                    </div>   
                </div>    
                @endif







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
                                            <td style="width: 50%; text-align: right;">@if ($order->payment_method == 'cod') Cash On Delivery @elseif($order->payment_method == 'paytm') PayTM @elseif($order->payment_method == 'payu') PayU @elseif($order->payment_method == 'voucher') Voucher @endif</td>    
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
        
                                    @if ($order->payment_method != 'cod' && $order->status != 'checkout_pending' && $order->status != 'payment_failed' && $order->status != 'payment_pending')
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
                        @php $shipmentEligible = true; @endphp
                        @foreach ($order->OrderItems as $item)
                            @if ($item->status != 'packing_completed') @php $shipmentEligible = false; @endphp @endif
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
                                                        <div class="col-5">
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
                                                            @elseif($item->status == 'order_cancelled')
                                                            <span class="text-danger">
                                                                <span style="">
                                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                                </span>
                                                                Order Cancelled.
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
                                                                Shipment #{{ $item->shipment->tracking_id }} Created, Waiting For Pickup.
                                                            </span>
                                                            @elseif($item->status == 'item_shipped')
                                                            <span style="color: #2874f0">
                                                                <span style="">
                                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                                </span>
                                                                Shipment <strong>#{{ $item->shipment->tracking_id }}</strong> Shipped via <strong>{{ $item->shipment->courier_name }}</strong>.
                                                            </span>
                                                            @elseif($item->status == 'item_delivered')
                                                            <span class="text-success">
                                                                <span style="">
                                                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                                                </span>
                                                                Item Delivered
                                                            </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-7" style="text-align: right;">


                                                            @if ($order->delivery_type == 'physical')
                                                                @if ($item->status == 'order_placed')
                                                                    <a data-toggle="modal" data-target="#StartPackingModal{{$item->id}}" class="btn btn-dark">START PACKING</a>
                                                                @elseif($item->status == 'packing_started')
                                                                    <a data-toggle="modal" data-target="#PackingCompletedModal{{$item->id}}" class="btn btn-dark">PACKING COMPLETED</a>
                                                                @elseif($item->status == 'packing_completed')
                                                                    {{-- <a href="{{ route('admin-create-shipment-view', $item->id) }}" class="btn btn-dark">CREATE SHIPMENT</a> --}}
                                                                @endif

                                                            @elseif($order->delivery_type == 'electronic')
                                                            <form action="{{ route('admin-send-license-key') }}" method="post" class="w-100">
                                                                <div class="input-group mb-3">
                                                                    @csrf
                                                                    <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                                                    <input type="text" class="form-control" name="license_key" value="{{ $item->OrderItemLicense->ProductLicense->key ?? '' }}" placeholder="License Key" @if (isset($item->OrderItemLicense->ProductLicense->key)) disabled @endif>
                                                                    @if ($item->status == 'order_placed')
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-success">SEND</button>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </form>
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












@if ($shipmentEligible)
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
                        
                            <a href="{{ route('admin-create-shipment', $order->id) }}" class="btn btn-block btn-dark" type="submit">Create Shipment</a>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endif





@endsection