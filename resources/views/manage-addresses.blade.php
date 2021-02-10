@extends('layouts.menu-layout')

@section('title', 'Manage Addresses')

@section('manage-addresses-nav', 'account-menu-item-active')

@section('modals')
<div id="AddAddressModalDiv">
    <div class="modal fade" id="AddAddressModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

           <div class="modal-body row">
                <div class="row w-100">
                    <div class="col-6">
                        <div class="form-group">
                          <label for="NewAddressName">Name</label>
                          <input type="text" id="NewAddressName" class="form-control" placeholder="Name" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="NewAddressMobile">Mobile Number</label>
                            <input type="text" id="NewAddressMobile" class="form-control" placeholder="10-Digit Mobile Number" aria-describedby="helpId">
                          </div>
                    </div>
                </div>



                <div class="row w-100">
                    <div class="col-6">
                        <div class="form-group">
                          <label for="NewAddressName">Locality</label>
                          <input type="text" id="NewAddressLocality" class="form-control" placeholder="Locality" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="NewAddressCity">City/Town/District</label>
                            <input type="text" id="NewAddressCity" class="form-control" placeholder="i.e Gotham City" aria-describedby="helpId">
                          </div>
                    </div>
                </div>

                

                <div class="row w-100">
                    <div class="col-6">
                        <div class="form-group">
                          <label for="NewAddressName">State</label>
                          <input type="text" id="NewAddressLocality" class="form-control" placeholder="State" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="NewAddressCity">Alternate Mobile</label>
                            <input type="text" id="NewAddressCity" class="form-control" placeholder="Alternate Mobile (Optional)" aria-describedby="helpId">
                          </div>
                    </div>
                </div>



           </div>

          

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary">ADD ADDRESS</button>
              </div>
        </div>
        </div>
    </div>  
</div>
@endsection

@section('right-col-menu')
    
<div class="account-details-container">

    <div class="right-account-container ">

        <div class="account-details-title">
            <span>Manage Addresses</span>
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
                <div class="_1CeZIA">
                    <div class="_26SF1Q">
                        <div class="umgxnI">
                            <div class="dpjmKp">
                                <img src="{{ asset('img/svg/dots.svg') }}">
                                <div class="_3E8aIl _1UHYca">
                                    <div class="_16FXBY">
                                        <span>Edit</span>
                                    </div>
                                    <div class="_16FXBY">
                                        <span>Delete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="_2FCIZU">
                                <span class="_1GczDM">HOME</span>
                            </div>
                            <p class="_2adSi5">
                                <span class="_3CfVDh">Aniket Das</span>
                                <span class="_1Z7fmh _3CfVDh">9123037267</span>
                            </p>
                            <span class="_2adSi5 WlNme0">Keutia, Kankinara, Keutia, North Twenty Four Parganas District, West Bengal - 
                                <span class="_2dQV-8">743126</span>
                            </span>
                    </div>
                </div>
            </div>
        

        </div>

    </div>
    
</div>

@endsection