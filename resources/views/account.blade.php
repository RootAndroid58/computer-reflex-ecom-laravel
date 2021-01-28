@extends('layouts.menu-layout')

@section('title', 'My Account')

@section('profile-information-nav', 'account-menu-item-active')

@section('right-col-menu')
    
<div class="right-account-container account-details-container">
                
    <div class="account-section">
        <div class="account-details-title">
            <span>Personal Information</span>
            <a href="#">Edit</a>
        </div>

        <div class="_1TlPi6 row">
            <div class="_1YVqbV">
                <div class="_1Jqgld">
                    <input type="text" class="_1w3ZZo _1YmvCG _2mFmU7" name="name" required="" disabled="" autocomplete="name" tabindex="1" value="{{Auth()->user()->name}} ">
                </div>
            </div>
        </div>
    </div>

    <div class="account-section">

        <div class="row">
            <div class="col-6">
                <div class="account-details-title">
                    <span>Email Address</span>
                    <a href="#">Edit</a>
                </div>
           
                <div class="_1TlPi6 row">
                    <div class="_1YVqbV w-100">
                        <div class="_1Jqgld">
                            <input type="text" class="_1w3ZZo _1YmvCG _2mFmU7" name="lastName" disabled="" autocomplete="name" tabindex="2" value="{{Auth()->user()->email}}">
                        </div>
                    </div>
                </div>
            </div>

                    
        <div class="col-6">
            <div class="account-details-title">
                <span>Mobile Number</span>
                <a href="#">Edit</a>
            </div>
    
            <div class="_1TlPi6 row">
                <div class="_1YVqbV w-100">
                    <div class="_1Jqgld">
                        <input type="text" class="_1w3ZZo _1YmvCG _2mFmU7" name="mobile" disabled="" autocomplete="name" tabindex="2" value="{{Auth()->user()->mobile ?? 'Not Registered'}}">
                    </div>
                </div>
            </div>
        </div>

        </div>

    </div>


    <div class="account-section account-faqs-section">
        <div class="account-details-title">
            <span>FAQs</span>
        </div>
        <h4>This is a dummy question?</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
    
    
        <h4>This is a dummy question?</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
    
    
        <h4>This is a dummy question?</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
    
    
        <h4>This is a dummy question?</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
    
    </div>

    <div class="account-section account-details-bottom-svg">
        <img class="" src="{{ asset('img/svg/pride.svg') }}" alt="" srcset="">
    </div>

</div>

@endsection