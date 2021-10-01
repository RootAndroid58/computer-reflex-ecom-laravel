
<div class="body-container" id="CartContainer">
    
    <div class="container">
    <div class="row">
    <div class="col-md-9">
    <div class="account-details-container">
    
     
        <div class="right-wishlist-container"  style="min-height: 80vh;">
    
            <div class="wishlist-basic-padding">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <span>@if (Auth::check()){{ FirstWord(Auth()->user()->name)}}'s @endif Shopping Cart ({{$cart->count()}} @if ($cart->count() > 1)Items @else Item @endif)</span>
                </div>
            </div>
    
            <div class="account-menu-break"></div>   
                    @if (!isset($cart[0]))
                    <div class="wishlist-container">
                        <div class="wishlist-basic-padding">
                            <div class="w-100"  >
                                <div class="blank-wishlist-container text-center">
                                    <div class="blank-wishlist-img-container" style="margin-top: 50px;">
                                        <img class="img-nodrag" style="max-width: 35%" src="{{ asset('img/grey.gif') }}" data-src="{{ asset('img/svg/blank-cart.png') }}">
                                    </div>
                                    <div class="blank-wishlist-txt-container text-center" style="margin-top: 30px;">
                                        <span style="font-weight: 500; font-size: 20px;">Empty Cart!</span>
                                        <br>
                                        <span>You have no items in your cart. Start adding!</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                    @else
                            
                <div class="wishlist-container">   

                  
                    <form action="{{ route('checkout-post') }}" method="post" id="CartCheckOutForm"> @csrf
                    @foreach ($cart as $cart)
                    @foreach ($cart->Products as $Product) 
    
                    @php $StockCounter = 1; 
                    if ($Product->delivery_type == 'physical') {
                        $physicalItems = true;
                    } else if ($Product->delivery_type == 'electronic') {
                        $electroniclItems = true;
                    }
                    
                    @endphp
                      
                            <div class="row wishlist-basic-padding" id="CartItem{{ $Product->id }}" style="padding-bottom: 0;">
                                <div class="col-md-3">
                                    <a href="{{route('product-index', $Product->id)}}" target="_blank">
                                        <div class="wish-product-image-container">
                                            <img loading="lazy" src="{{ asset('storage/images/products/'.$cart->Images->image) }}" alt="">
                                        </div>

                                    </a>
                                </div>
    
                                <div class="col-md-8">
                                    <a href="{{route('product-index', $Product->id)}}" target="_blank">
                                        <span class="wish-product-title font-weight-500 color-0066c0">{{ $Product->product_name }}</span>
                                    </a>
                                    
                                    <div class="details-price" style="margin-bottom: 0;">
                                        <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>₹</s></font><s> {{ moneyFormatIndia($Product->product_mrp * $cart->qty) }}</s></span>
                                        <br>
                                        <span><font class="rupees" style="font-size: 18px">₹</font> <span style="font-size: 18px;">{{ moneyFormatIndia($Product->product_price * $cart->qty) }}</span> 
                                            <b style="font-size: 15px; color: #388e3c; font-weight: 500;"> 
                                                {{ round((($Product->product_mrp - $Product->product_price) / $Product->product_mrp)*100) }}% off
                                            </b>  
                                        </span>
                                        @php
                                        if (!$Product->product_stock <= 0) {
                                            $ProductMRPTotal = $ProductMRPTotal+$Product->product_mrp * $cart->qty;
                                            $ProductPriceTotal = $ProductPriceTotal+$Product->product_price * $cart->qty;
                                            
                                        }
                                        @endphp

                                        <div class="row">
                                            <div class="col-4">
                                                @if($Product->product_stock <= 0)
                                                <p class="text-danger" style="font-weight: 500;"></i>Out of stock!</p>
                                                @else
                                                <input type="hidden" name="product_id[]" value="{{ $Product->id }}">
                                                    <div class="input-group input-group-sm" style="max-width: 160px;">
                                                        <div class="input-group-prepend">
                                                        <label class="input-group-text" for="product-quantity">Qty</label>
                                                        </div>
                                                        <select class="custom-select" id="product-quantity-{{ $Product->id }}" name="product_qty[]" onchange="ChangeQty('{{ $Product->id }}')">
                                                        @while ($StockCounter <= $Product->product_stock)
                                                            <option @if ($cart->qty == $StockCounter) selected @endif value="{{$StockCounter}}">{{$StockCounter}}</option>
                                                            {{ $StockCounter++ }}
                                                        @endwhile
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-8">
                                                @if ($Product->delivery_type == 'electronic')
                                                    <span class="text-success font-weight-bold">e-Delivery</span>
                                                @endif
                                            </div>
                                        </div>

                                       
                                        

                                    </div>
                                </div>
                                        
                                <div class="col-md-1">
                                    <div class="wishlist-remove-btn-container">
                                        <div>
                                            <a id="CartRemoveBtn" onClick="ToggleCart('{{$Product->id}}')" target="_blank">
                                                <span>
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </span>
                                            </a>
                                        </div>                            
                                    </div>
                                </div>
                            </div>

                            <div class="row wishlist-basic-padding" style="padding-top: 0;"></div>

                        <div class="account-menu-break" id="CartBreak{{ $Product->id }}"></div>      
                        @endforeach 
                        @endforeach 
                    </form>
                    </div> 
                    @endif

                </div>
        
            </div>
        </div>

    
            <div class="col-md-3" >
                <div class="account-details-container row" style="padding: 13px 24px;">
                    <span style="font-size: 16px; font-weight: 500;">PRICE DETAILS</span>
                </div>
                <div class="account-details-container row">
                    <div class="account-menu-items-container">
                            <span>MRP</span>
                            <span class="float-right"><strong><font class="rupees">&#8377;</font>{{ moneyFormatIndia($ProductMRPTotal) }}</strong></span>
                    </div>
                    <div class="account-menu-items-container">
                        <span>Discount</span>
                        <span class="float-right"><strong style="font-weight: 500; color: #388e3c;">- <font class="rupees">&#8377;</font>{{ moneyFormatIndia($ProductMRPTotal - $ProductPriceTotal) }}</strong></span>
                    </div>
                    <div class="account-menu-items-container">
                        <span>Delivery Charges</span>
                        <span class="float-right"><strong style="font-weight: 500; color: #388e3c;">FREE</strong></span>
                    </div>
                    <div class="account-menu-items-container"  style="font-weight: 600; color: black; font-size: 18px; border-top: 1px dashed #e0e0e0; border-bottom: 1px dashed #e0e0e0; margin-top: 18px; margin-bottom: 18px;">
                        <span>Total Amount</span>
                        <span class="float-right"><font class="rupees">&#8377;</font>{{ moneyFormatIndia($ProductPriceTotal) }}</span>
                    </div>
                
                    <div id="errorContainer" class="w-100">
                        @if ($physicalItems == true && $electroniclItems == true)
                        <div class="alert alert-danger mb-0" role="alert" style="font-size: 12px;">
                            <strong>Products with email delivery and physical delivery can't be clubbed together, Place separate orders. </strong>
                        </div>
                        @else
                        <div class="w-100 cart-checkout-btn-container">
                            <button type="submit" form="CartCheckOutForm" class="">CHECKOUT &nbsp;<i class="fa fa-credit-card" aria-hidden="true"></i></button>
                        </div>
                        @endif
                    </div>
                   
                    
                    <div class="account-menu-break"></div> 

                </div>
            </div>
      
        </div>
    </div>
</div>
