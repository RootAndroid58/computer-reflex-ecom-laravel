@extends('layouts.support-menu-layout')

@section('title', 'Contact Us')

@section('nav-contact-us', 'account-menu-item-active')
    

@section('right-menu-col')
<div class="right-account-container" style="padding: 0;">
    <div class="wishlist-basic-padding" style="padding: 24px 32px 0px 32px">
        <span>Please login first to be able to Raise A Ticket with High Priority or else you can simply contact us on the channels below.</span>
    </div>

        <div class="wishlist-basic-padding " style="padding: 24px 32px 0px 32px">
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



        <div class="wishlist-basic-padding " style="padding: 24px 32px 0px 32px">
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


        <div class="wishlist-basic-padding " style="padding: 24px 32px 0px 32px">
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