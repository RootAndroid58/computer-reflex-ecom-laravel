@extends('layouts.mobile-common')

@section('title', 'Contact Us')

@section('burger-contact-us-menu', 'account-menu-item-active')

@section('content')
<div class="container-fluid pt-3    " >
    @if (!Auth::check())
    <div class="" >
        <span>Please login first to be able to Raise A Ticket with High Priority or else you can simply contact us on the channels below.</span>
    </div>
    @endif
        
        <div class="mt-3" >
            <div class="w-100">
                <span style="font-size: 17px; font-weight: 600;">
                    <span>
                        <i class="fas fa-phone-alt"></i>&nbsp;
                    </span>
                    <span>
                        Telephone Number
                    </span>
                </span>
            </div>
            <div class="w-100">
                <p>
                    <a href="tel:+91 8902984277" class="static-blue" target="_blank">+91 8902984277</a> 
                </p>
            </div>
        </div>
       
      



        <div class=" " >
            <div class="w-100">
                <span style="font-size: 17px; font-weight: 600;">
                    <span>
                        <i class="fas fa-headset"></i>&nbsp;
                    </span>
                    <span>
                        Contact / Query
                    </span>
                </span>
            </div>
            <div class="w-100">
                <p>
                    <a href="mailto:{{ env('CONTACT_EMAIL') }}" class="static-blue" target="_blank">{{ env('CONTACT_EMAIL') }}<br></a> 
                    <a href="mailto:{{ env('QUERY_EMAIL') }}" class="static-blue" target="_blank">{{ env('QUERY_EMAIL') }}</a>
                </p>
            </div>
        </div>


        <div class=" " >
            <div class="w-100">
                <span style="font-size: 17px; font-weight: 600;">
                    <span>
                        <i class="far fa-building"></i>&nbsp;
                    </span>
                    <span>
                        Address
                    </span>
                </span>
            </div>
            <div class="w-100">
                <p>
                    121/5E/1F Satin Sen Sarani,<br>
                    Manicktala Main Rd,<br>
                    Kolkata, 700054<br>
                    WB, IN
                </p>
            </div>
        </div>
   



</div>
@endsection
    
