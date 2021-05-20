@if (isMobile())

    @include('mobile.account')

{{ die }}
@endif


@extends('layouts.menu-layout')

@section('title', 'My Account')

@section('profile-information-nav', 'account-menu-item-active')

@section('modals')

@endsection

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

@section('bottom-js')

{{-- Name Update --}}
    <script>
        $('#NameEditBtn').click(function (e) {
            e.preventDefault()
            $('#NameEditBtn').addClass('d-none')
            $('#UpdateName').removeAttr("disabled")
            $('#UpdateName').focus()
            $('#NameSubmitBtn').removeClass('d-none')
            $('#NameEditCloseBtn').removeClass('d-none')
        })
    </script>

    <script>
        $('#NameEditCloseBtn').click(function (e) {
            e.preventDefault()
            $('#NameEditBtn').removeClass('d-none')
            $('#UpdateName').attr("disabled", "disabled")
            $('#NameSubmitBtn').addClass('d-none')
            $('#NameEditCloseBtn').addClass('d-none')

                $.ajax({
                url: "{{route('get-auth-name')}}",
                method: 'GET',
                success: function (data) {
                    $('#UpdateName').val(data)
                }
            })
        })
    </script>

    <script>
        $('#NameUpdateForm').submit(function (e) {
            e.preventDefault()
            var new_name = $('#UpdateName').val()

                $.ajax({
                url: "{{route('update-name')}}",
                method: 'POST',
                data: {
                    'new_name'  : new_name,
                },
                success: function (data) {
                    $('#ProfileDetailsDiv').load("{{ route('my-account') }} #ProfileDetailsDiv")
                    $('#UpdateName').val(data)
                    $('#NameEditBtn').removeClass('d-none')
                    $('#UpdateName').attr("disabled", "disabled")
                    $('#NameSubmitBtn').addClass('d-none')
                    $('#NameEditCloseBtn').addClass('d-none')
                    $(".bootstrap-growl").remove();
                    $.bootstrapGrowl("Name Updated", {
                        type: "success",
                        offset: {from:"bottom", amount: 50},
                        align: 'center',
                        allow_dismis: true,
                        stack_spacing: 10,
                    })
                }
            })
        })
    </script>



{{-- Email Update --}}
    <script>
        $('#EmailEditBtn').click(function (e) {
            e.preventDefault()
            $('#EmailEditBtn').addClass('d-none')
            $('#UpdateEmail').removeAttr("disabled")
            $('#UpdateEmail').focus()
            $('#EmailSubmitBtn').removeClass('d-none')
            $('#EmailEditCloseBtn').removeClass('d-none')
        })
    </script>

    <script>
        $('#EmailEditCloseBtn').click(function (e) {
            e.preventDefault()
            $('#EmailEditBtn').removeClass('d-none')
            $('#UpdateEmail').attr("disabled", "disabled")
            $('#EmailSubmitBtn').addClass('d-none')
            $('#EmailEditCloseBtn').addClass('d-none')

                $.ajax({
                url: "{{route('get-auth-email')}}",
                method: 'GET',
                success: function (data) {
                    $('#UpdateEmail').val(data)
                }
            })
        })
    </script>

    <script>
        $('#EmailUpdateForm').submit(function (e) {
            e.preventDefault()
            var new_email = $('#UpdateEmail').val()

                $.ajax({
                url: "{{route('update-email')}}",
                method: 'POST',
                data: {
                    'new_email'  : new_email,
                },
                success: function (data) {
                    $('#UpdateEmail').val(data)
                    $('#EmailEditBtn').removeClass('d-none')
                    $('#UpdateEmail').attr("disabled", "disabled")
                    $('#EmailSubmitBtn').addClass('d-none')
                    $('#EmailEditCloseBtn').addClass('d-none')
                    $(".bootstrap-growl").remove();
                    $.bootstrapGrowl("Email Updated", {
                        type: "success",
                        offset: {from:"bottom", amount: 50},
                        align: 'center',
                        allow_dismis: true,
                        stack_spacing: 10,
                    })
                }
            })
        })
    </script>


{{-- Email Update --}}
    <script>
        $('#MobileEditBtn').click(function (e) {
            e.preventDefault()
            $('#MobileEditBtn').addClass('d-none')
            $('#UpdateMobile').removeAttr("disabled")
            $('#UpdateMobile').focus()
            $('#MobileSubmitBtn').removeClass('d-none')
            $('#MobileEditCloseBtn').removeClass('d-none')
        })
    </script>

    <script>
        $('#MobileEditCloseBtn').click(function (e) {
            e.preventDefault()
            $('#MobileEditBtn').removeClass('d-none')
            $('#UpdateMobile').attr("disabled", "disabled")
            $('#MobileSubmitBtn').addClass('d-none')
            $('#MobileEditCloseBtn').addClass('d-none')

                $.ajax({
                url: "{{route('get-auth-mobile')}}",
                method: 'GET',
                success: function (data) {
                    $('#UpdateMobile').val(data)
                }
            })
        })
    </script>

    <script>
        $('#MobileUpdateForm').submit(function (e) {
            e.preventDefault()
            var new_mobile = $('#UpdateMobile').val()

                $.ajax({
                url: "{{route('update-mobile')}}",
                method: 'POST',
                data: {
                    'new_mobile'  : new_mobile,
                },
                success: function (data) {
                    $('#UpdateMobile').val(data)
                    $('#MobileEditBtn').removeClass('d-none')
                    $('#UpdateMobile').attr("disabled", "disabled")
                    $('#MobileSubmitBtn').addClass('d-none')
                    $('#MobileEditCloseBtn').addClass('d-none')
                    $(".bootstrap-growl").remove();
                    $.bootstrapGrowl("Mobile Updated", {
                        type: "success",
                        offset: {from:"bottom", amount: 50},
                        align: 'center',
                        allow_dismis: true,
                        stack_spacing: 10,
                    })
                }
            })
        })
    </script>




@endsection