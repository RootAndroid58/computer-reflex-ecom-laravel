@extends('layouts.common')

@section('title', 'Redeem Voucher')

@section('content')
    
<div class="body-container pb-5">

    <div class="container" style="background-color: white;">
        <div class="banner-container text-center" style="padding: 24px 36px;">
            <div class="banner-image-div prod-back-div mb-3" style="width: 100%; height: 246px; background-image: url('{{ asset('img/svg/gift.svg') }}');">
            </div>
            <h3 style=" color: #383838;">Redeem <font style="font-weight: 700;">Voucher</font>. </h3>
        </div>
       
        <div class="row " style="padding: 24px 36px;">
            <form class="w-100" action="{{ route('redeem-voucher') }}"  method="get">
            <div class="input-group mb-3">
                <input type="text" name="code" value="{{ request()->code }}" class="form-control" placeholder="Secret Voucher Code i.e XXXXX-XXXXX-XXXXX-XXXXX" aria-label="Secret Voucher Code i.e XXXXX-XXXXX-XXXXX-XXXXX" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-dark" style="min-width: 275px;" type="submit">Validate</button>
                </div>
              </div>    
            </form>
                @if (isset($error))
                <div class="alert alert-danger w-100" role="alert">
                    <strong>{{ $error }}</strong>
                </div>
                @endif
                @if (isset($voucher) && $voucher->status == 'used' || isset($voucher->used_by))
                <div class="alert alert-danger w-100" role="alert">
                    <strong>Sorry! The voucher has already been used.</strong>
                </div>
                @endif
        </div>

        @if (isset($voucher))
            @if ($voucher->status == 'active')
            @php
                $outOfStock = false;    
            @endphp
            <form class="w-100" action="{{ route('checkout-post') }}" method="post"> @csrf
                @foreach ($voucher->products as $VoucherProduct)
                @php
                    $Product = $VoucherProduct->product;
                @endphp
                    <div class="row wishlist-basic-padding" style="padding-top: 0; padding: bottom:0;">
                        <input type="hidden" name="voucher_code" value="{{ $voucher->code }}">
                        <div class="col-md-2">
                            <a href="{{ url('product/'.$Product->id) }}" target="_blank">
                                <div class="wish-product-image-container">
                                    <img src="{{ asset('storage/images/products/'.$Product->Images[0]->image) }}" alt="">
                                </div>
                            </a>
                        </div>

                        <div class="col-md-10">
                            <a href="{{ url('product/'.$Product->id) }}" target="_blank">
                                <span class="wish-product-title font-weight-500 color-0066c0">{{ $Product->product_name }}</span>
                            </a>
                            {{-- Mrp - Price - Dsicount --}}
                            <div class="details-price">
                                <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>&#8377;</font> {{ number_format($Product->product_mrp, 2, ".", ",") }}</s></span>
                                <br>
                                <span style="font-size: 14px;"><span class="text-secondary">Special Price: </span><font class="rupees" style="font-size: 18px">&#8377;</font><span style="font-size: 18px;">{{ number_format($VoucherProduct->special_price, 2, ".", ",") }}</span> 
                                    <b style="font-size: 15px; color: #388e3c; font-weight: 500;">
                                        {{ ((($Product->product_mrp - $VoucherProduct->special_price) / $Product->product_mrp)*100)%100 }}% off
                                    </b>  
                                </span>
                                
                                
                                <div>
                                    @if ($Product->product_stock < $VoucherProduct->qty)
                                        @php
                                            $outOfStock = true;
                                        @endphp
                                        <span class="text-danger font-weight-bold">Not Enough Stock</span>
                                    @endif
                                </div>

                            </div>
                        </div>  
                    </div>
                    <div class="account-menu-break"></div>
                @endforeach

                <div class="w-100 text-center mt-3 mb-3">
                    @if (!$outOfStock)
                        <button class="btn btn-dark" style="width: 245px;" type="submit">Proceed To Checkout</button>
                    @else
                        <span class="text-danger font-weight-bold">One or more products dosen't have enough stock to proceed with this order, try again later. <br> Sorry for the inconvenience</span>
                    @endif
                </div>
                

            </form>
            @endif  
        @endif



            <div class="row bg-light" style="padding: 24px 36px;">
                <div class="col-md-4">
                    <div class="step-container text-center">
                        <div class="prod-back-div" style="margin: auto; width: 75px; height: 75px; background-image: url('{{ asset('img/svg/time_management.svg') }}');"></div>
                        <div class="ac-welcome-page-benefit-step-no mt-2">
                            1
                        </div>
                        <br>
                        <div class="mt-1">
                            <span style="font-size: 21px; color: black; ">Sign Up</span>
                        </div>
                        
                        <br>
                        <span style="font-size: 16px;">Few Clicks Signup, Complete Paperless Process. Join Thousands Of Associates & Customers Community.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-container text-center">
                        <div class="prod-back-div" style="margin: auto; width: 75px; height: 75px; background-image: url('{{ asset('img/svg/share_link.svg') }}');"></div>
                        <div class="ac-welcome-page-benefit-step-no mt-2">
                            2
                        </div>
                        <br>
                        <div class="mt-1">
                            <span style="font-size: 21px; color: black; ">Share</span>
                        </div>
                        
                        <br>
                        <span style="font-size: 16px;">Generate Your Special Affiliate Links & Share Via Whatsapp, Instagram or Anything.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-container text-center">
                        <div class="prod-back-div" style="margin: auto; width: 75px; height: 75px; background-image: url('{{ asset('img/svg/wallet.svg') }}');"></div>
                        <div class="ac-welcome-page-benefit-step-no mt-2">
                            3
                        </div>
                        <br>
                        <div class="mt-1">
                            <span style="font-size: 21px; color: black; ">Earn</span>
                        </div>
                        <br>
                        <span style="font-size: 16px;">Earn Commision On Every Purchases Made Thourgh Your Links, And Instantly Payout Your Earnings.</span>
                    </div>
                </div>
            </div>
        



        <div class="row" style="padding: 24px 32px 32px 32px;">
            <div class="text-center w-100">
                <span style="font-size: 19px; font-weight: 600;">Having Any Problem?</span>
                <br>
                <a  href="{{ route('support') }}" class="btn btn-info mt-3">CONTACT US</a>
            </div>
        </div>
    
    </div>


</div>
@endsection