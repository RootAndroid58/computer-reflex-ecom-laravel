@extends('layouts.common')

@section('title', 'My Cart')
    
@section('css-js')
    
@endsection

@section('content')


<div class="body-container">
    
    <div class="container">
    <div class="row">
    <div class="col-md-9">
    <div class="account-details-container">
    
        <div class="right-wishlist-container " style="min-height: 80vh;">
    
            <div class="wishlist-basic-padding">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <span>Master's Wishlist (1)</span>
                </div>
            </div>
    
            <div class="account-menu-break"></div>     
                    
                <div class="wishlist-container">                                    
                            <div class="row wishlist-basic-padding" id="WishItem1" style="padding-bottom: 0;">
                                <div class="col-md-3">
                                    <a href="http://localhost:8000/product/1" target="_blank">
                                        <div class="wish-product-image-container">
                                            <img src="http://localhost:8000/storage/images/products/ZmO4YcJe9zk0uWx3L9VksjPeCHzwGzahG4Do0wUJ.jpg" alt="">
                                        </div>

                                    </a>
                                </div>
    
                                <div class="col-md-8">
                                    <a href="http://localhost:8000/product/1" target="_blank">
                                        <span class="wish-product-title font-weight-500 color-0066c0">G.SKILL Trident Z 16GB (2 x 8GB) DDR4 3200Mhz RGB Series Memory - F43200C16D16GTZR</span>
                                    </a>
                                    
                                    <div class="details-price" style="margin-bottom: 0;">
                                        <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>₹</s></font><s> 35,799.00</s></span>
                                        <br>
                                        <span><font class="rupees" style="font-size: 18px">₹</font> <span style="font-size: 18px;">10,599.00</span> 
                                            <b style="font-size: 15px; color: #388e3c; font-weight: 500;"> 70% off </b>  
                                        </span>

                                        <div class="input-group input-group-sm" style="max-width: 160px;">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text" for="product-quantity">Qty</label>
                                            </div>
                                            <select class="custom-select" id="product-quantity">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                        
                                <div class="col-md-1">
                                    <div class="wishlist-remove-btn-container">
                                        <div>

                                        </div>                            
                                    </div>
                                </div>
                            </div>

                            <div class="row wishlist-basic-padding" id="WishItem1" style="padding-top: 0;">
                                <div class="col-3">

                                </div>
                            </div>
                        <div class="account-menu-break" id="WishBreak1"></div>       
                    </div> 
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="account-details-container row" style="padding: 13px 24px;">
                    <span style="font-size: 16px; font-weight: 500;">PRICE DETAILS</span>
                </div>
                <div class="account-details-container row">
                    <div class="account-menu-items-container">
                        <div class="price-detail-item row">
                            {{-- Price details --}}
                        </div>
                    </div>

                    <div class="account-menu-break"></div> 

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('bottom-js')
    
@endsection