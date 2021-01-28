@extends('layouts.menu-layout')
{{-- {{ dd($data) }} --}}
@php 
$UserName=str_word_count(Auth()->user()->name, 1); 
@endphp
@section('title', $UserName[0]."'s Wishlist")

@section('wishlist-information-nav', 'account-menu-item-active')

@section('css-js')
    
@endsection

@section('right-col-menu')
<div class="account-details-container">

    <div class="right-account-container ">

        <div class="account-details-title">
            <span>{{ $UserName[0] }}'s Wishlist (22)</span>
        </div>

        <div class="wishlist-container">

            @foreach ($data as $data)
                <div class="row">
                    <div class="col-md-2">
                        <div class="wish-product-image-container">
                            {{ $data->wishlist->images }}
                            <img src="{{ asset('storage/images/products/') }}" alt="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <span class="wish-product-title"></span>
                    </div>

                    <div class="col-md-4">

                    </div>
                </div>
            @endforeach


    

        </div>

    </div>
    
</div>
@endsection