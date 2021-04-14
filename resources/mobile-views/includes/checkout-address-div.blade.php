<div id="addresses-container-div">
    <div class="account-details-container">
        <div class="right-account-container ">
            <div class="account-details-title">
                <span>Delivery Address</span>
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
                        <div class="_1CeZIA " id="AddressContainer{{$address->id}}">
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
                                        <span class="_1GczDM">{{ $address->updated_at }}</span>
                                    </div>
                                    <p class="_2adSi5">
                                        <span class="_3CfVDh">{{ $address->name }}</span>
                                        <span class="_1Z7fmh _3CfVDh">{{$address->mobile}}</span>
                                    </p>
                                    <span class="_2adSi5 WlNme0">{{$address->house_no}}, {{$address->locality}}, {{$address->city}}, {{$address->district}}, {{$address->state}} - 
                                        <span class="_2dQV-8">{{$address->pin_code}}</span>
                                    </span>
                                    <div><button type="submit" class="btn btn-sm btn-dark float-right mt-3" onclick="SelectAddress({{$address->id}})">Deliver To This Address</button></div>
                            </div>
                        </div>              
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>