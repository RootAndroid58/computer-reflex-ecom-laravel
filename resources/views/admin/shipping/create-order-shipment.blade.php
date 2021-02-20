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
    <div class="row">
    <div class="col-md-12">
    <div class="account-details-container">
        <div class="right-wishlist-container" style="min-height: 0;">
    
            <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <img src="{{ asset('/img/svg/packages.svg') }}" width="50" alt="" srcset="">
                    <span style="padding-right: 0;"><font style="font-weight: 600; color: black;">Create Shipment</font></span> #{{ date_format($order->created_at,"Y-mdHis").'-'.$order->id }}
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container ">   
    
                        <div class="account-menu-break"></div>     
                            
                            <div class="wishlist-basic-padding">
                                <div class="order-confirmation-notes">
                                    <span>Order ID: <span style="font-weight: 600; color: black;">{{ $order->id }}</span></span><br>
                                    <span>Order Date: <span style="font-weight: 600; color: black;">{{ $order->created_at }}</span></span><br>
                                    <span>Delivery By: <span style="font-weight: 600; color: black;">{{ date_format(new DateTime($order->delivery_date), "dS M, Y (D)") }}</span></span><br>
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
                            <span style="font-weight: 600; color: black;">Shipment Details <font color="red">*</font></span>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container">                                            

                        <div class="account-menu-break"></div>     
                         
                            <div class="wishlist-basic-padding" style="padding-bottom: 0;">
                                    <form action="{{ route('admin-create-shipping-order') }}" method="post"> @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <div class="row">
                                            <div class="form-group col-6">
                                            <label for="courier_name">Shipping Courier</label>
                                            <select class="form-control" name="courier_name" id="courier_name">
                                                <option value="delhivery">Delhivery</option>
                                                <option value="bluedart">Blue Dart</option>
                                                <option value="dtdc">DTDC</option>
                                            </select>
                                            </div>

                                            <div class="form-group col-6">
                                            <label for="tracking_id">Shipment Tracking ID </label>
                                            <input type="text"
                                                class="form-control" name="tracking_id" id="tracking_id" aria-describedby="helpId" placeholder="Tracking Id">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                              <label for="">Delivery Date</label>
                                              <input type="date"
                                                class="form-control" name="delivery_date" id="" aria-describedby="helpId" placeholder="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success float-right">Create Shipment</button>
                                            </div>
                                        </div>

                                    </form>                          
                            </div>

                            <div class="row wishlist-basic-padding" style="padding-top: 0;"></div>

                        <div class="account-menu-break"></div>      
                         
                    </div> 
                    
                </div>
        
            </div>
        </div>
      
        </div>
    </div>














        



@endsection