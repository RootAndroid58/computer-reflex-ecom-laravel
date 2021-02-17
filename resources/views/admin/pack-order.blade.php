@extends('layouts.panel')

@section('title', 'Start Packing')

@section('nav-manage-orders', 'active')

@section('css-js')
    
@endsection



@section('content')

<div class="container-fluid">

    <h3>Pack Order</h3>

</div>


<div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="account-details-container">
        <div class="right-wishlist-container" style="min-height: 0;">
    
            <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <img src="{{ asset('/img/svg/packages.svg') }}" width="50" alt="" srcset="">
                    <span style="padding-right: 0;"><font style="font-weight: 600; color: black;">Pack Order</font></span> #{{ date_format($order->created_at,"Y-mdHis").'-'.$order->id }}
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                                                
                <div class="wishlist-container ">   
    
                        <div class="account-menu-break"></div>     
                            
                            <div class="wishlist-basic-padding">
                             
                            </div>
                            
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>


@endsection