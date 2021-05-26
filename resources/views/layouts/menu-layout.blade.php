@extends('layouts.common')

@section('content') <div class="body-container">

    @yield('modals')
                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="updateDpURL" value="{{ route('dp-update') }}">
                          <div class="img-container">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-primary" id="crop">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>




<div class="container">
    <div class="row">

    <div class="col-md-3">
            <div id="ProfileDetailsDiv">
                <div class="account-details-container row" style="padding: 12px; margin-bottom: 0;">
                    <img class="account-dp" id="avatar" src="{{ asset('img/grey.gif') }}" data-src="{{ asset('storage/images/dp/'.Auth()->user()->dp)}}">
                    <div class="account-greet">
                        <div class="account-hello">Hello,</div>
                        <div class="account-name">{{Auth()->user()->name}}</div>
                    </div>               
                </div>
                <div class="row">
                    <div class="pb-4 text-center w-100">
                        <label class="label w-100">
                            <span class="btn btn-dark btn-sm btn-block"  >Change DP</span>
                            <input type="file" class="sr-only" id="dp_uploader" name="image" accept="image/*">
                        </label>
                    </div>
                </div>
                
            </div>
        
                <div class="account-details-container row">
                    
                    <div class="account-menu-items-container">
                        <a style="width: 100%;" href="{{ route('orders') }}" >
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/orders.svg') }}" alt="" srcset="">
                            <span style="width: calc(100% - 26px);padding-left: 20px;font-size: 16px;font-weight: 500;margin-top: 10px;">MY ORDERS</span> 
                            <img src="{{ asset('img/svg/next.svg') }}" alt="" class="account-menu-arrow " >
                        </div>
                    </a>
                    </div>
                

                    <div class="account-menu-break"></div> {{-- Underline --}}

                    <div class="account-menu-items-container">
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/user.svg') }}" alt="" srcset="">
                            <a style="cursor: default">ACCOUNT SETTINGS</a>
                        </div>
                    </div>
                        
                    
                    <div class="w-100" style="padding-bottom: 12px;">
                        <a style="width: 100%;" href="{{ route('my-account') }}"><div class="account-menu-item @yield('profile-information-nav')">Profile Information</div></a>
                        <a style="width: 100%;" href="{{ route('addresses') }}"><div class="account-menu-item @yield('manage-addresses-nav')">Manage Addresses</div></a>
                        <a style="width: 100%;" href="/account/pancard"><div class="account-menu-item">PAN Card Information</div></a>
                    </div>


                    <div class="account-menu-break"></div> {{-- Underline --}}

                    <div class="account-menu-items-container">
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/stuff.svg') }}" alt="" srcset="">
                            <a style="cursor: default; width: 100%;">MY STUFF</a>
                        </div>
                    </div>

                    <div class="w-100" style="padding-bottom: 12px;">
                        <a href="{{route('wishlist')}}"><div class="account-menu-item @yield('wishlist-information-nav')">My Wishlist</div></a>
                    </div>
                    
                    <div class="account-menu-break"></div> {{-- Underline --}}

                    <div class="account-menu-items-container" style="cursor: pointer;">
                        <div class="account-head-menu">
                            <img src="{{ asset('img/svg/logout.jpg') }}" alt="" srcset="" >
                            <a style="width: 100%;" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </div>


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