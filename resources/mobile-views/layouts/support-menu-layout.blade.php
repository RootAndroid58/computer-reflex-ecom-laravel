@extends('layouts.common')


@section('content')
<div class="body-container">


    <div class="container">

        <div class="row">
            <div class="col-md-3">        
                        <div class="account-details-container row">
                            <div class="account-menu-break"></div> 
                                <div class="account-menu-items-container">
                                    <div class="account-head-menu">
                                        <img style="width: 25px;" src="{{asset('img/svg/call-center-worker.svg')}}" alt="" srcset="">
                                        <a style="cursor: default">GET IN TOUCH</a>
                                    </div>
                                </div>

                                <div class="w-100" style="padding-bottom: 12px;">
                                    @if (Auth::check())
                                    <a style="width: 100%;" href="{{route('support.raise-support-ticket')}}"><div class="account-menu-item @yield('nav-raise-support-ticket')">Raise Support Ticket</div></a>
                                    <a style="width: 100%;" href="{{route('support.support-tickets')}}"><div class="account-menu-item @yield('nav-support-tickets')">Support Tickets</div></a>
                                    @endif
                                   
                                    
                                    <a style="width: 100%;" href="{{route('support.contact-us')}}"><div class="account-menu-item @yield('nav-contact-us')">Contact Us</div></a>
                                </div>

                            @if (Auth::check())
                            <div class="account-menu-break"></div> 

                                <div class="account-menu-items-container">
                                    <div class="account-head-menu">
                                        <img src="{{ asset('img/svg/stuff.svg') }}" alt="" srcset="">
                                        <a style="cursor: default; width: 100%;">SELF HELP</a>
                                    </div>
                                </div>
                                

                            <div class="w-100" style="padding-bottom: 12px;">
                                <a href="{{ route('my-account') }}"><div class="account-menu-item ">Edit Account</div></a>
                                <a href="{{ route('addresses') }}"><div class="account-menu-item ">Manage Addressse</div></a>
                                <a href="{{ route('wishlist') }}"><div class="account-menu-item ">My Wishlist</div></a>
                            </div>
                            
                            <div class="account-menu-break"></div> 

                            <div class="account-menu-items-container" style="cursor: pointer;">
                                <div class="account-head-menu">
                                    <img src="{{asset('img/svg/logout.jpg')}}" alt="" srcset="">
                                    <a style="width: 100%;" href="{{route('logout')}}">Logout</a>
                                </div>
                            </div>
                        @endif
                           

                    </div>
            </div>


                <div class="col-md-9">
                    @yield('right-menu-col')
                    
                </div>

        </div>
    </div>
    

</div>
@endsection
