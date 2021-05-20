@extends('layouts.mobile-common')

@section('title', 'My Account')

@section('burger-my-account-menu', 'account-menu-item-active')

@section('css-js')
    <style>
        .account-details-title {
            padding-bottom: 9px;
        }
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .alert {
      display: none;
    }

    .img-container img {
      max-width: 100%;
    }
    </style>
@endsection

@section('modals')
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
                    <img id="image" src="">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" id="crop">Upload</button>
                </div>
              </div>
            </div>
          </div>
@endsection

@section('content')

<div class="profile-picture-section bg-secondary " style="min-height: 20vh;">
    <div class="pt-4 pb-4 justify-content-center align-items-center d-flex">
        <img id="avatar"  src="{{ asset('storage/images/dp/'.Auth()->user()->dp) }}" alt="" style=" width: 150px; height: 150px; border-radius: 50%;">
    </div>
    <div class="pb-4 text-center">
        <label class="label">
            <span class="btn btn-dark btn-sm "  >Change DP</span>
            <input type="file" class="sr-only" id="dp_uploader" name="image" accept="image/*">
        </label>
    </div>
</div>


<div>
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
      </div>
      <div class="alert" role="alert"></div>
</div>



<div class="container-fluid">
     
    <div class="account-section mt-3" style="padding-bottom: 15px;">
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
                        <button id="NameSubmitBtn" type="submit" form="NameUpdateForm" class="btn btn-primary btn-sm btn-block d-none ">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="account-section">

        <div class="account-details-title">
            <span>Email Address</span>
            <a class="" id="EmailEditBtn">Edit</a>
            <a style="color: red;" class="d-none" id="EmailEditCloseBtn">Cancel</a>
        </div>
    
        <div class="_1TlPi6 row" style="margin-bottom: 20px;" >
            <div class="_1YVqbV ">
                <form id="EmailUpdateForm">
                    <div class="_1Jqgld">
                        <input type="text" id="UpdateEmail" class="_1w3ZZo _1YmvCG _2mFmU7" name="lastName" disabled="" required autocomplete="name" tabindex="2" value="{{Auth()->user()->email}}">
                        <button id="EmailSubmitBtn" form="EmailUpdateForm" type="submit" class="btn btn-primary btn-block btn-sm d-none">SAVE</button>
                    </div>
                </form>
            </div>
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
                        <button id="MobileSubmitBtn" type="submit" form="MobileUpdateForm" class="btn btn-primary btn-block btn-sm d-none">SAVE</button>
                    </div>
                </form>
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