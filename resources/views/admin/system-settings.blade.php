@extends('layouts.panel')

@section('nav-system-settings', 'active')

@section('title','System Settings')


@section('content')


<div class="container-fluid">

    <h3>System Settings</h3>

    <div class="container account-details-container mb-4" style="padding-left: 0; padding-right: 0;">
        
            <div class="pt-3 pl-4 pb-3 bg-dark">
                <span style="font-size: 18px; font-weight: 800; color:white;">Checkout Methods</span>
            </div>
            <div class="w-100 account-menu-break row" style="padding: 24px 24px;">
                <div class="col-10">
                    <span style="font-weight: 600; font-size: 19px;">
                       <strong>PayU</strong> - Checkout using PayUMoney payment gateway.
                    </span>
                </div>
                <div class="col-2">
                    <p class="custom-control custom-switch custom-switch-lg m-0">
                        <input class="custom-control-input checkBtn" data-key="PayuCheckout" id="payu_checkout" type="checkbox"
                        @if (App\Models\SystemSetting::where('key', 'PayuCheckout')->first()->value == 'active')
                            checked
                        @endif
                        >
                        <label class="custom-control-label font-italic" for="payu_checkout"></label>
                    </p>
                </div>
            </div>
      
            <div class="w-100 account-menu-break row" style="padding: 24px 24px;">
                <div class="col-10">
                    <span style="font-weight: 600; font-size: 19px;">
                       <strong>PayTM</strong> - Checkout using PayTM payment gateway.
                    </span>
                </div>
                <div class="col-2">
                    <p class="custom-control custom-switch custom-switch-lg m-0">
                        <input class="custom-control-input checkBtn" data-key="PaytmCheckout" id="paytm_checkout" type="checkbox"
                        @if (App\Models\SystemSetting::where('key', 'PaytmCheckout')->first()->value == 'active')
                            checked
                        @endif
                        >
                        <label class="custom-control-label font-italic" for="paytm_checkout"></label>
                    </p>
                </div>
            </div>

            <div class="w-100 account-menu-break row" style="padding: 24px 24px;">
                <div class="col-10">
                    <span style="font-weight: 600; font-size: 19px;">
                       <strong>COD</strong> - Checkout using Cash On Delivery mode.
                    </span>
                </div>
                <div class="col-2">
                    <p class="custom-control custom-switch custom-switch-lg m-0">
                        <input class="custom-control-input checkBtn" data-key="CODCheckout" id="cod_checkout" type="checkbox"
                        @if (App\Models\SystemSetting::where('key', 'CODCheckout')->first()->value == 'active')
                            checked
                        @endif
                        >
                        <label class="custom-control-label font-italic" for="cod_checkout"></label>
                    </p>
                </div>
            </div>
            
        </div>




    <div class="container account-details-container" style="padding-left: 0; padding-right: 0;">
        <div class="pt-3 pl-4 pb-3 bg-dark">
            <span style="font-size: 18px; font-weight: 800; color:white;">General Settings</span>
        </div>
        <div class="w-100 account-menu-break row" style="padding: 24px 24px;">
            <div class="col-10">
                <span style="font-weight: 600; font-size: 19px;">
                    <strong>Local Cache Clear</strong> - Force all browsers to clear cache, and load fresh content.
                </span>
            </div>
            <div class="col-2">
                <p class="custom-control m-0">
                    <button class="btn btn-dark btn-sm" onclick="UpdateSetting('AssetCache', 'btn')">Clear &nbsp;<i class="fas fa-trash-alt"></i></button>
                </p>
            </div>
        </div>
    </div>

    <input type="hidden" name="" id="settings_update_url" value="{{ route('admin-system-settings-update') }}">
</div> <!--Container-Fluid End-->
@endsection

@section('bottom-js')
    <script>

        $('.checkBtn').on('change', function () {
            var key = $(this).data();
            if ($(this).is(':checked')) {
                var type = 'active';
            } else {
                var type = 'inactive';
            }
            UpdateSetting(key, type);
        });



        function UpdateSetting(key, type) {
            $.ajax({
                url: $('#settings_update_url').val(),
                method: 'GET',
                data: {
                    key: key,
                    type: type,
                },
                success:function (data) {
                    $(".bootstrap-growl").remove();
                    $.bootstrapGrowl(data.message, {
                        type: data.type,
                        offset: {from:"bottom", amount: 100},
                        align: 'center',
                        allow_dismis: true,
                        stack_spacing: 10,
                    });
                }
            });
        }
    </script>
@endsection