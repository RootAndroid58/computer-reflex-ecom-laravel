@extends('layouts.menu-layout')

@section('title', 'Manage Addresses')

@section('manage-addresses-nav', 'account-menu-item-active')

@section('modals')
<div id="AddAddressModalDiv">
    <div class="modal fade" id="AddAddressModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Address (India Only)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

           <div class="modal-body">
               <form id="AddAddressForm" style="width: 100%"> @csrf
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="NewAddressName">Receiver's Name <font color="red">*</font></label>
                            <input required name="name"  type="text" id="NewAddressName" class="form-control" placeholder="i.e Jarvis" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="NewAddressHouse">House No. / Apt. <font color="red">*</font></label>
                            <input required name="house" type="text" id="NewAddressHouse" class="form-control" placeholder="Stark Tower" aria-describedby="helpId">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                            <label for="NewAddressLocality">Locality <font color="red">*</font></label>
                            <input required name="locality" type="text" id="NewAddressLocality" class="form-control" placeholder="i.e 200 Park Ave" aria-describedby="helpId">
                            </div>
                        </div>

                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressCity">City/Town <font color="red">*</font></label>
                                <input required name="city" type="text" id="NewAddressCity" class="form-control" placeholder="i.e Midtown Manhattan" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressDistrict">District <font color="red">*</font></label>
                                <input required name="district" type="text" id="NewAddressDistrict" class="form-control" placeholder="i.e New York" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressState">State <font color="red">*</font></label>
                                <input required name="state" type="text" id="NewAddressState" class="form-control" placeholder="i.e New York" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressPin">Postal PIN Code <font color="red">*</font></label>
                                <input required name="pin_code" type="text" id="NewAddressPin" class="form-control" placeholder="Postal PIN Code" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressMobile">Mobile Number <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+91</span>
                                    </div>
                                    <input required name="mobile" type="text" id="NewAddressMobile" class="form-control" placeholder="10-Digit Mobile Number" aria-describedby="helpId">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressAltMobile">Alternate Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+91</span>
                                    </div>
                                    <input name="altMobile" type="text" id="NewAddressAltMobile" class="form-control" placeholder="Optional" aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
           </div>
        
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="submit" form="AddAddressForm" class="btn btn-primary">ADD ADDRESS</button>
              </div>
        </div>
        </div>
    </div>  
</div>


<div id="EdiAddressModalDiv">
    <div class="modal fade" id="EditAddressModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Addres (India Only)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

           <div class="modal-body">
               <form id="EditAddressForm" style="width: 100%"> @csrf <input type="hidden" name="address_id" value="">
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="NewAddressName">Receiver's Name <font color="red">*</font></label>
                            <input required name="name"  type="text" id="NewAddressName" class="form-control" placeholder="i.e Jarvis" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="NewAddressHouse">House No. / Apt. <font color="red">*</font></label>
                            <input required name="house" type="text" id="NewAddressHouse" class="form-control" placeholder="Stark Tower" aria-describedby="helpId">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                            <label for="NewAddressLocality">Locality <font color="red">*</font></label>
                            <input required name="locality" type="text" id="NewAddressLocality" class="form-control" placeholder="i.e 200 Park Ave" aria-describedby="helpId">
                            </div>
                        </div>

                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressCity">City/Town <font color="red">*</font></label>
                                <input required name="city" type="text" id="NewAddressCity" class="form-control" placeholder="i.e Midtown Manhattan" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressDistrict">District <font color="red">*</font></label>
                                <input required name="district" type="text" id="NewAddressDistrict" class="form-control" placeholder="i.e New York" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressState">State <font color="red">*</font></label>
                                <input required name="state" type="text" id="NewAddressState" class="form-control" placeholder="i.e New York" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressPin">Postal PIN Code <font color="red">*</font></label>
                                <input required name="pin_code" type="text" id="NewAddressPin" class="form-control" placeholder="Postal PIN Code" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressMobile">Mobile Number <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+91</span>
                                    </div>
                                    <input required name="mobile" type="text" id="NewAddressMobile" class="form-control" placeholder="10-Digit Mobile Number" aria-describedby="helpId">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="NewAddressAltMobile">Alternate Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+91</span>
                                    </div>
                                    <input name="altMobile" type="text" id="NewAddressAltMobile" class="form-control" placeholder="Optional" aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
           </div>
        
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="submit" form="EditAddressForm" class="btn btn-primary">SAVE CHANGES</button>
              </div>
        </div>
        </div>
    </div>  
</div>
@endsection

@section('right-col-menu')
<div id="addresses-container-div">
<div class="account-details-container">
    <div class="right-account-container ">
        <div class="account-details-title">
            <span>Delivery Addresse ({{$addresses->count()}})</span>
        </div>


        <div class="wishlist-container">
            <div class="add-address-box-wrapper">
                <a href="#AddAddress" data-toggle="modal" data-target="#AddAddressModal">
                    <div class="add-address-box">
                        <img src="{{ asset('img/svg/times.svg') }}" alt="" srcset="">
                        <span>ADD A NEW ADDRESS</span>
                    </div>
                </a>
            </div>
            <div>
                {{-- {{Dd($addresses->count())}} --}}
                @if ( !isset($addresses[0]))
                    <div class="wishlist-container">
                        <div class="wishlist-basic-padding">
                            <div class="w-100"  >
                                <div class="blank-wishlist-container text-center">
                                    <div class="blank-wishlist-img-container" style="margin-top: 50px;">
                                        <img class="img-nodrag" style="max-width: 35%" src="{{ asset('img/svg/no-address.svg') }}">
                                    </div>
                                    <div class="blank-wishlist-txt-container text-center" style="margin-top: 30px;">
                                        <span style="font-weight: 500; font-size: 20px;">No Address Added!</span>
                                        <br>
                                        <span>Please add one!</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                @else
                    @foreach ($addresses as $address)
                    <div class="_1CeZIA">
                        <div class="_26SF1Q">
                            <div class="umgxnI">
                                <div class="dpjmKp">
                                    <img src="{{ asset('img/svg/dots.svg') }}">
                                    <div class="_3E8aIl _1UHYca">
                                        <div class="_16FXBY" onclick="EditAddress({{$address->id}})">
                                            <span>Edit</span>
                                        </div>
                                        <div class="_16FXBY" onclick="RemoveAddress({{$address->id}})">
                                            <span>Delete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="_2FCIZU">
                                    <span class="_1GczDM">{{$address->updated_at}}</span>
                                </div>
                                <p class="_2adSi5">
                                    <span class="_3CfVDh">{{$address->name}}</span>
                                    <span class="_1Z7fmh _3CfVDh">{{$address->mobile}}</span>
                                </p>
                                <span class="_2adSi5 WlNme0">{{$address->house_no}}, {{$address->locality}}, {{$address->city}}, {{$address->district}}, {{$address->state}} - 
                                    <span class="_2dQV-8">{{$address->pin_code}}</span>
                                </span>
                        </div>
                    </div>              
                    @endforeach
                @endif

            </div>
        </div>
    </div>

</div>
</div>
@endsection

@section('bottom-js')

    <script>
        function EditAddress(AddressID) {
            console.log(AddressID)

            $.ajax({
                url: "{{ route('edit-address-fetch') }}",
                method: 'POST',
                data: {
                    'AddressID'      : AddressID,
                },
                success: function (data) {
                    console.log(data.address)
                    $('#EditAddressForm').find("input[name='address_id']").val(data.address.id)
                    $('#EditAddressForm').find("input[name='name']").val(data.address.name)
                    $('#EditAddressForm').find("input[name='house']").val(data.address.house_no)
                    $('#EditAddressForm').find("input[name='locality']").val(data.address.locality)
                    $('#EditAddressForm').find("input[name='city']").val(data.address.city)
                    $('#EditAddressForm').find("input[name='district']").val(data.address.district)
                    $('#EditAddressForm').find("input[name='state']").val(data.address.state)
                    $('#EditAddressForm').find("input[name='pin_code']").val(data.address.pin_code)
                    $('#EditAddressForm').find("input[name='mobile']").val(data.address.mobile)
                    $('#EditAddressForm').find("input[name='altMobile']").val(data.address.alt_mobile)
                    $('#EditAddressModal').modal("toggle")
                }
            })

        }
    </script>


    <script>
        $('#EditAddressForm').submit(function (e) {
            e.preventDefault()

            $(this).find("input[name='address_id']").val()
            $(this).find("input[name='name']").val()
            $(this).find("input[name='house']").val()
            $(this).find("input[name='locality']").val()
            $(this).find("input[name='city']").val()
            $(this).find("input[name='district']").val()
            $(this).find("input[name='state']").val()
            $(this).find("input[name='pin_code']").val()
            $(this).find("input[name='mobile']").val()
            $(this).find("input[name='altMobile']").val()

            $.ajax({
                url: "{{ route('edit-address-submit') }}",
                method: 'POST',
                data: {
                    '_token'        : $(this).find("input[name='_token']").val(),
                    'address_id'    : $(this).find("input[name='address_id']").val(),
                    'name'          : $(this).find("input[name='name']").val(),
                    'house'         : $(this).find("input[name='house']").val(),
                    'locality'      : $(this).find("input[name='house']").val(),
                    'city'          : $(this).find("input[name='house']").val(),
                    'district'      : $(this).find("input[name='district']").val(),
                    'state'         : $(this).find("input[name='state']").val(),
                    'pin_code'      : $(this).find("input[name='pin_code']").val(),
                    'mobile'        : $(this).find("input[name='mobile']").val(),
                    'altMobile'     : $(this).find("input[name='altMobile']").val(),
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#EditAddressForm').find("input[name='address_id']").val('')
                        $('#EditAddressForm').find("input[name='name']").val('')
                        $('#EditAddressForm').find("input[name='house']").val('')
                        $('#EditAddressForm').find("input[name='locality']").val('')
                        $('#EditAddressForm').find("input[name='city']").val('')
                        $('#EditAddressForm').find("input[name='district']").val('')
                        $('#EditAddressForm').find("input[name='state']").val('')
                        $('#EditAddressForm').find("input[name='pin_code']").val('')
                        $('#EditAddressForm').find("input[name='mobile']").val('')
                        $('#EditAddressForm').find("input[name='altMobile']").val('')

                        $('#EditAddressModal').modal("toggle")

                        $('#addresses-container-div').load("{{ route('addresses') }} #addresses-container-div")
                        $(".bootstrap-growl").remove();
                        $.bootstrapGrowl("Address Updated.", {
                            type: "success",
                            offset: {from:"bottom", amount: 50},
                            align: 'center',
                            allow_dismis: true,
                            stack_spacing: 10,
                        })
                    }
                }
            })
        })
    </script>





    <script>
        function RemoveAddress(AddressID) {

                $.ajax({
                url: "{{ route('remove-address-submit') }}",
                method: 'POST',
                data: {
                    'AddressID'      : AddressID,
                },
                success: function (data) {
                    if (data == 200) {
                        $(".bootstrap-growl").remove();
                        $.bootstrapGrowl("Address Removed.", {
                            type: "info",
                            offset: {from:"bottom", amount: 50},
                            align: 'center',
                            allow_dismis: true,
                            stack_spacing: 10,
                        })
                        $('#addresses-container-div').load("{{ route('addresses') }} #addresses-container-div")
                    }
                }
            })


        }
    </script>


    <script>
        $('#AddAddressForm').submit(function (e) { 
            
            e.preventDefault()

            var _token    = $(this).find("input[name='_token']").val()
            var name      = $(this).find("input[name='name']").val()
            var house     = $(this).find("input[name='house']").val()
            var locality  = $(this).find("input[name='locality']").val()
            var city      = $(this).find("input[name='city']").val()
            var district  = $(this).find("input[name='district']").val()
            var state     = $(this).find("input[name='state']").val()
            var pin_code  = $(this).find("input[name='pin_code']").val()
            var mobile    = $(this).find("input[name='mobile']").val()
            var altMobile = $(this).find("input[name='altMobile']").val()

                $.ajax({
                url: "{{route('add-address-submit')}}",
                method: 'POST',
                data: {
                    '_token'    : _token,
                    'name'      : name,
                    'house'     : house,
                    'locality'  : locality,
                    'city'      : city,
                    'district'  : district,
                    'state'     : state,
                    'pin_code'  : pin_code,
                    'mobile'    : mobile,
                    'altMobile' : altMobile,
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#AddAddressForm').find("input[name='name']").val('')
                        $('#AddAddressForm').find("input[name='house']").val('')
                        $('#AddAddressForm').find("input[name='locality']" ).val('')
                        $('#AddAddressForm').find("input[name='city']").val('')
                        $('#AddAddressForm').find("input[name='district']").val('')
                        $('#AddAddressForm').find("input[name='state']").val('')
                        $('#AddAddressForm').find("input[name='pin_code']").val('')
                        $('#AddAddressForm').find("input[name='mobile']" ).val('')
                        $('#AddAddressForm').find("input[name='altMobile']").val('')

                        $(".bootstrap-growl").remove();

                        $.bootstrapGrowl("Address Added.", {
                            type: "success",
                            offset: {from:"bottom", amount: 50},
                            align: 'center',
                            allow_dismis: true,
                            stack_spacing: 10,
                        })

                        $('#AddAddressModal').modal('toggle');

                        $('#addresses-container-div').load("{{ route('addresses') }} #addresses-container-div")
                    }
                }
            })

        })
    </script>
@endsection