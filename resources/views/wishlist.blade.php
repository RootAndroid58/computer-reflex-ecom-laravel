@if (isMobile())

    @include('mobile.wishlist')

{{ die }}
@endif


@extends('layouts.menu-layout')

@section('title', FirstWord(Auth()->user()->name)."'s Wishlist")

@section('wishlist-information-nav', 'account-menu-item-active')

@section('css-js')
    
@endsection

@section('right-col-menu')

@livewire('basic-helper')
<div class="account-details-container">
    <div class="right-wishlist-container ">
        @livewire('wishlist-container')
    </div>

</div>
@endsection
