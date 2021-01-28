@extends('layouts.menu-layout')

@section('title', 'Manage Addresses')

@section('manage-addresses-nav', 'account-menu-item-active')

@section('right-col-menu')
    
<div class="account-details-container">

    <div class="right-account-container ">

        <div class="account-details-title">
            <span>Manage Addresses</span>
        </div>

        <div class="wishlist-container">
            <div class="add-address-box-wrapper">
                <a href="#AddAddress">
                    <div class="add-address-box">
                        <img src="{{ asset('img/svg/times.svg') }}" alt="" srcset="">
                        <span>ADD A NEW ADDRESS</span>
                    </div>
                </a>
            </div>





            <div>
                <div class="_1CeZIA">
                    <div class="_26SF1Q">
                        <div class="umgxnI">
                            <div class="dpjmKp">
                                <img src="{{ asset('img/svg/dots.svg') }}">
                                <div class="_3E8aIl _1UHYca">
                                    <div class="_16FXBY">
                                        <span>Edit</span>
                                    </div>
                                    <div class="_16FXBY">
                                        <span>Delete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="_2FCIZU">
                                <span class="_1GczDM">HOME</span>
                            </div>
                            <p class="_2adSi5">
                                <span class="_3CfVDh">Aniket Das</span>
                                <span class="_1Z7fmh _3CfVDh">9123037267</span>
                            </p>
                            <span class="_2adSi5 WlNme0">Keutia, Kankinara, Keutia, North Twenty Four Parganas District, West Bengal - 
                                <span class="_2dQV-8">743126</span>
                            </span>
                    </div>
                </div>
            </div>
        

        </div>

    </div>
    
</div>

@endsection