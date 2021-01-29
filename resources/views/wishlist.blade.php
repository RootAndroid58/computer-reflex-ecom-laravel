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


            @if (!isset($wishlist[0]))
            <div class="wishlist-container">
                <div class="wishlist-basic-padding">
                    <div class="w-100"  >
                        <div class="blank-wishlist-container text-center">
                            <div class="blank-wishlist-img-container" style="margin-top: 50px;">
                                <img class="img-nodrag" style="max-width: 35%" src="{{ asset('img/svg/blank-wishlist.png') }}">
                            </div>
                            <div class="blank-wishlist-txt-container text-center" style="margin-top: 30px;">
                                <span style="font-weight: 500; font-size: 20px;">Empty Wishlist!</span>
                                <br>
                                <span>You have no items in your wishlist. Start adding!</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
            @else
    
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
            @endif
        


    </div>



</div>
@endsection

@section('bottom-js')

<script>

    function ToogleWishlist(product_id) {

        $('#WishItem'+product_id).fadeOut()
        $('#WishBreak'+product_id).fadeOut()

        $.ajax({
            url: "{{route('toogle-wishlist-btn')}}",
            method: 'POST',
            data: {
                'product_id' : product_id,
            },
            success: function (data) {

                if (data == 500) {
                    console.log('Product ID. ' + product_id + ' removed from wishlist')
                } else if(data == 200) {
                    console.log('Error removing product from wishlist.')
                }
            }
        })

    }

        


    

</script>
    
@endsection