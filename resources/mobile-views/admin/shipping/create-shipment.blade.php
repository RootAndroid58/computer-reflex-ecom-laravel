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



<div class="container">
    <form action="{{route('admin-create-shipment-submit')}}" method="post">
    
        

    </form>
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
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container">   
    
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
                                                        @endif
                                                    </div>

                        
                                                </div>
                                                
                                        </div>
                                    </p>
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
                    <span style="font-weight: 600; color: black;">Shipping Details</span>
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
            <div class="wishlist-basic-padding">

                <form action="{{ route('admin-create-shipment-submit') }}" method="post"> @csrf
                    <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="courier_name">Courier Partner</label>
                                <select class="form-control" name="courier_name" id="courier_name">
                                  <option value="DTDC">DTDC</option>
                                  <option value="Blue Dart">Blue Dart</option>
                                  <option value="Delhivery">Delhivery</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                              <label for="tracking_id">Tracking ID</label>
                              <input type="text"
                                class="form-control" name="tracking_id" id="tracking_id" aria-describedby="helpId" placeholder="Tracking ID">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                              <label for="delivery_date">Delivery Date</label>
                              <input type="date" class="form-control" name="delivery_date" id="delivery_date" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-success">Create Shipment</button>
                        </div>
                    </div>
                  

                </form>

            </div>
                    
        </div>
        
    </div>
    </div>
    </div>
</div>




        



@endsection