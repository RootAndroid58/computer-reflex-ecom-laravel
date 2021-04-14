@extends('layouts.affiliate-menu-layout')

@section('title', 'Affiliate Settings')

@section('affiliate-settings-nav', 'account-menu-item-active')

@section('right-col-menu')
    
     
<div class="right-account-container " style="padding: 0;">
        
    <div class="container-fluid">
        <div style="padding: 24px 24px;">
            <h4 class="mb-3" style="font-weight: 600;">Affiliate Settings</h4>
        </div>
    </div>
   
    <div class="container-fluid">
        <div class="row" >
            <div class="w-100 " style="padding: 24px 24px;">
                <div class="col-10">
                    <span style="font-weight: 600; font-size: 19px;">
                        Show Commision Details On Products Page.
                    </span>
                </div>
                <div class="col-2">
                    <!-- Custom switch -->
                    <p class="custom-control custom-switch custom-switch-lg m-0">
                       <input class="custom-control-input" id="customSwitch8" type="checkbox">
                       <label class="custom-control-label font-italic" for="customSwitch8"></label>
                   </p>
               </div>
            </div>

            <div class="w-100" style="padding: 24px 24px;">
                <div class="col-10">
                    <span style="font-weight: 600; font-size: 19px;">
                        Show Affiliate Toolbar On Page Top.
                    </span>
                </div>
                <div class="col-2">
                    <!-- Custom switch -->
                    <p class="custom-control custom-switch custom-switch-lg m-0">
                       <input class="custom-control-input" id="ToolbarToggleBtn" type="checkbox">
                       <label class="custom-control-label font-italic" for="ToolbarToggleBtn"></label>
                   </p>
               </div>
            </div>

        </div>
    </div>



        
</div>

    

@endsection
    