@extends('layouts.affiliate-menu-layout')

@section('title', 'Affiliate Dashboard')

@section('right-col-menu')
    
<div class="right-account-container account-details-container">
     
        <div class="account-section">
            <div class="account-details-title">
                <span>Personal Information</span>
                <a href="#" class="" id="NameEditBtn">Edit</a>
                <a href="#" style="color: red;" class="d-none" id="NameEditCloseBtn">Cancel</a>
            </div>

            <div class="_1TlPi6 row">
                <div class="_1YVqbV">
                    <form id="NameUpdateForm">
                        <div class="_1Jqgld">
                            <input type="text" class="_1w3ZZo _1YmvCG _2mFmU7" id="UpdateName" required="" disabled autocomplete="name" tabindex="1" value="{{Auth()->user()->name}} ">
                        </div>
                    </form>
                </div>
                <button id="NameSubmitBtn" form="NameUpdateForm" class="btn btn-primary btn-lg d-none" style="height: 100%; height: 45px;">SAVE</button>
            </div>
        </div>
   

    <div class="account-section">

     
            <div class="account-details-title">
                <span>Email Address</span>
                <a href="#" class="" id="EmailEditBtn">Edit</a>
                <a href="#" style="color: red;" class="d-none" id="EmailEditCloseBtn">Cancel</a>
            </div>
        
            <div class="_1TlPi6 row" style="margin-bottom: 20px;" >
                <div class="_1YVqbV ">
                    <form id="EmailUpdateForm">
                        <div class="_1Jqgld">
                            <input type="text" id="UpdateEmail" class="_1w3ZZo _1YmvCG _2mFmU7" name="lastName" disabled="" required autocomplete="name" tabindex="2" value="{{Auth()->user()->email}}">
                        </div>
                    </form>
                </div>
                <button id="EmailSubmitBtn" form="EmailUpdateForm" class="btn btn-primary btn-lg d-none" style="height: 100%; height: 45px;">SAVE</button>
            </div>
    

        
            <div class="account-details-title">
                <span>Mobile Number</span>
                <a href="#" class="" id="MobileEditBtn">Edit</a>
                <a href="#" style="color: red;" class="d-none" id="MobileEditCloseBtn">Cancel</a>
            </div>
    
            <div class="_1TlPi6 row">
                <div class="_1YVqbV">
                    <form id="MobileUpdateForm">
                        <div class="_1Jqgld">
                            <input type="text" id="UpdateMobile" class="_1w3ZZo _1YmvCG _2mFmU7" name="mobile" disabled="" required autocomplete="name" tabindex="2" value="{{Auth()->user()->mobile ?? 'Not Registered'}}">
                        </div>
                    </form>
                </div>
                <button id="MobileSubmitBtn" form="MobileUpdateForm" class="btn btn-primary btn-lg d-none" style="height: 100%; height: 45px;">SAVE</button>
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
    