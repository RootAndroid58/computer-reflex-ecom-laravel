@extends('layouts.menu-layout')
@php 
$UserName=str_word_count(Auth()->user()->name, 1); 
@endphp
@section('title', $UserName[0]."'s Wishlist")

@section('wishlist-information-nav', 'account-menu-item-active')

@section('css-js')
    
@endsection

@section('right-col-menu')
<div class="account-details-container">

    <div class="right-wishlist-container ">

        <div class="wishlist-basic-padding">
            <div class="account-details-title" style="padding-bottom: 0px;">
                <span>{{ $UserName[0] }}'s Wishlist ({{$wishlistCount}})</span>
            </div>
        </div>

        <div class="account-menu-break"></div> {{-- Underline --}}

        <div class="wishlist-container">
        @foreach ($wishlist as $wishlist)
            @foreach ($wishlist->Products as $Product) 
          
                <div class="row wishlist-basic-padding" id="WishItem{{ $Product->id }}">
                    <div class="col-md-3">
                        <a href="{{ url('product/'.$Product->id) }}" target="_blank">
                            <div class="wish-product-image-container">
                                <img src="{{ asset('storage/images/products/'.$wishlist->Images->image) }}" alt="">
                            </div>
                        </a>
                    </div>

                    <div class="col-md-8">
                        <a href="{{ url('product/'.$Product->id) }}" target="_blank">
                            <span class="wish-product-title font-weight-500 color-0066c0">{{ $Product->product_name }}</span>
                        </a>
                        {{-- Mrp - Price - Dsicount --}}
                        <div class="details-price">
                            <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>&#8377;</font> {{ number_format($Product->product_mrp, 2, ".", ",") }}</s></span>
                            <br>
                            <span><font class="rupees" style="font-size: 18px">&#8377;</font> <span style="font-size: 18px;">{{ number_format($Product->product_price, 2, ".", ",") }}</span> 
                                <b style="font-size: 15px; color: #388e3c; font-weight: 500;">
                                    {{ ((($Product->product_mrp - $Product->product_price) / $Product->product_mrp)*100)%100 }}% off
                                </b>  
                            </span>
                            <div>
                                <a id="AddToCartBtn" target="_blank" class="">
                                    <span>
                                        <i class="fa fa-cart-plus" aria-hidden="true"></i> Add To Cart 
                                    </span>
                                </a>  
                            </div>

                        </div>
                    </div>
                              
                    <div class="col-md-1">
                        <div class="wishlist-remove-btn-container">
                            <div>
                                <a id="WishlistRemoveBtn" onClick="ToogleWishlist('{{$Product->id}}')" target="_blank">
                                    <span>
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>                            
                        </div>
                    </div>
             

                </div>
            
                <div class="account-menu-break" id="WishBreak{{$Product->id}}"></div> {{-- Underline --}}
            
            @endforeach
        @endforeach
        </div> 
    </div>



</div>
@endsection

@section('bottom-js')

<script>

    function ToogleWishlist(product_id) {
        console.log(product_id)

        $.ajax({
            url: "{{route('toogle-wishlist-btn')}}",
            method: 'POST',
            data: {
                'product_id' : product_id,
            },
            success: function (data) {

                if (data == 500) {
                    $('#WishItem'+product_id).remove()
                    $('#WishBreak'+product_id).remove()
                } else if(data == 200) {
                    console.log('Error removing product from wishlist.')
                }
            }
        })

    }

        


    

</script>
    
@endsection