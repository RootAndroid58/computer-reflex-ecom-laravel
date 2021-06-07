@if (isMobile())

    @include('mobile.wishlist')

{{ die }}
@endif



@extends('layouts.menu-layout')
@php 
$UserName=str_word_count(Auth()->user()->name, 1); 
@endphp
@section('title', FirstWord(Auth()->user()->name)."'s Wishlist")

@section('wishlist-information-nav', 'account-menu-item-active')

@section('css-js')
    
@endsection

@section('right-col-menu')

@livewire('basic-helper')

<div id="DynamicDiv">
<div class="account-details-container">

    <div class="right-wishlist-container ">

        <div class="wishlist-basic-padding">
            <div class="account-details-title" style="padding-bottom: 0px;">
                <span>{{ FirstWord(Auth()->user()->name) }}'s Wishlist ({{$wishlistCount}})</span>
            </div>
        </div>

        <div class="account-menu-break"></div> {{-- Underline --}}

            @if (!isset($wishlist[0]))
            <div class="wishlist-container">
                <div class="wishlist-basic-padding">
                    <div class="w-100"  >
                        <div class="blank-wishlist-container text-center">
                            <div class="blank-wishlist-img-container" style="margin-top: 50px;">
                                <img class="img-nodrag" style="max-width: 35%" src="{{ asset('img/grey.gif') }}" data-src="{{ asset('img/svg/blank-wishlist.png') }}">
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
                    @foreach ($wishlist->Products as $product) 
                        @livewire('wishlist-product', ['product' => $product], key($product->id))
                    @endforeach
                @endforeach
                </div> 
            @endif
        
    </div>
</div>
</div>
@endsection

@section('bottom-js')

<script>
    function ToggleWishlist(product_id) {

        $('#WishItem'+product_id).fadeOut()
        $('#WishBreak'+product_id).fadeOut()

        $.ajax({
            url: "{{route('toggle-wishlist-btn')}}",
            method: 'POST',
            data: {
                'product_id' : product_id,
            },
            success: function (data) {

                if (data.status == 500) {
                    $(".bootstrap-growl").remove();
                    $.bootstrapGrowl("Removed From Wishlist.", {
                        type: "danger",
                        offset: {from:"bottom", amount: 50},
                        align: 'center',
                        allow_dismis: true,
                        stack_spacing: 10,
                    })
                    $('#DynamicDiv').load("{{route('wishlist')}} #DynamicDiv")
                } else if(data.status == 200) {
                    console.log('Error removing product from wishlist.')
                }
            }
        })
    }
</script>
    
@endsection