@extends('layouts.common')

@section('content') <div class="body-container">

@yield('modals')
    
<div class="container">
    <div class="row">

    <div class="col-md-3">
            <div id="ProfileDetailsDiv">
                <div class="account-details-container row" style="padding: 12px;">
                    <img class="account-dp" src="{{ profilePicture(Auth()->user()->dp) }}">
                    <div class="account-greet">
                        <div class="account-hello">Hello,</div>
                        <div class="account-name">{{Auth()->user()->name}}</div>
                    </div>
                </div>
            </div>
        
                <div class="account-details-container row">
                    
                    <div class="account-menu-items-container @yield('affiliate-settings-nav')">
                        <a style="width: 100%;" href="{{ route('affiliate.settings') }}" >
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/settings.svg') }}" alt="" srcset="">
                            <span style="width: calc(100% - 26px);padding-left: 20px;font-size: 16px;font-weight: 500;margin-top: 10px;">SETTINGS</span> 
                            <img src="{{ asset('img/svg/next.svg') }}" alt="" class="account-menu-arrow " >
                        </div>
                    </a>
                    </div>
                
                    <div class="account-menu-break"></div> {{-- Underline --}}

                    <div class="account-menu-items-container">
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/eport.png') }}" alt="" srcset="">
                            <a style="cursor: default">REPORTS</a>
                        </div>
                    </div>
                        
                    
                    <div class="w-100" style="padding-bottom: 12px;">
                        <a style="width: 100%;" href="{{ route('affiliate.referred-purchases') }}"><div class="account-menu-item @yield('referred-purchases-nav')">Referred Purchases</div></a>
                        <a style="width: 100%;" href="{{ route('affiliate.reports') }}"><div class="account-menu-item @yield('affiliate-reports-nav')">Affiliate Reports</div></a>
                    </div>


                    <div class="account-menu-break"></div> {{-- Underline --}}

                    <div class="account-menu-items-container">
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/wallets2.svg') }}" alt="" srcset="">
                            <a style="cursor: default; width: 100%;">PAYMENT</a>
                        </div>
                    </div>

                    <div class="w-100" style="padding-bottom: 12px;">
                        <a href="{{route('affiliate.wallet')}}"><div class="account-menu-item @yield('wallet-nav')">Wallet</div></a>
                        <a href="{{route('affiliate.payment-modes')}}"><div class="account-menu-item @yield('payment-nav')">Payment Modes</div></a>
                        <a href="{{route('affiliate.payout')}}"><div class="account-menu-item @yield('payout-nav')">Payout</div></a>
                    </div>
                    
                    <div class="account-menu-break"></div> {{-- Underline --}}


            </div>
    </div>


        <div class="col-md-9">

            @yield('right-col-menu')


        </div>


</div>
</div>


</div> @endsection



@section('bottom-js')

@endsection