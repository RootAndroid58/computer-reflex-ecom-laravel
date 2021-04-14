@extends('layouts.common')

@section('title', 'Join Affiliate Marketing Program')
    
@section('modals')    
    <!-- Modal -->
    <div class="modal fade" id="AffiliateSignupModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: 500">Affiliate Sign-Up</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div>
                            <p>
                                By clicking the button below, you agree to the <a style="color: #007bff;" href="#">Terms & Conditions</a>. 
                            </p>
                            <p>
                                Your account will be upgraded as a Official Associate account of Computer Reflex.
                            </p>

                            <div class="form-group">
                              <label for="name">Associate Name</label>
                              <input readonly type="text" value="{{ Auth()->user()->name }}" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="email">Registered Email</label>
                              <input readonly type="text" value="{{ Auth()->user()->email }}" id="email" class="form-control">
                            </div>


                        </div>
                        <div class="w-100 text-center">
                            <form action="{{ route('affiliate.join-submit') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success" style="height: 40px; font-size: 16px;" >CONFIRM SIGN-UP</button>
                            </form>
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')

<div class="body-container pb-5">

    <div class="container" style="background-color: white;">
        <div class="banner-container text-center" style="padding: 24px 36px;">
            <div class="banner-image-div prod-back-div mb-3" style="width: 100%; height: 246px; background-image: url('{{ asset('img/svg/work_together.svg') }}');">
            </div>
            <h3 style=" color: #383838;">Join <font style="font-weight: 700;">Computer Reflex</font>'s Affiliate Program. </h3>
        </div>
       
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

            <div class="row">
                <div style="margin: auto; max-width: 300px; width: 200px;" class="mt-4">
                    <button data-toggle="modal" data-target="#AffiliateSignupModal" class="btn btn-dark btn-lg btn-block" style="height: 45px; font-size: 18px;">SIGN UP</button>
                </div>
            </div>
        


        <div class="row mt-3" style="padding: 12px 32px 12px 32px;">
            <div class="col-md-3">
                <div class="prod-back-div" style="width: 100%; height: 246px; background-image: url('{{ asset('img/svg/Data_trends.svg') }}');"></div>
            </div>
            <div class="col-md-9 ">
                <div class="mb-1">
                    <span style="font-size: 19px; font-weight: 600;">Reports</span>
                </div>
                <p style="font-size: 16px;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="account-menu-break"></div>
        </div>


        <div class="row bg-light" style="padding: 12px 32px 12px 32px;">
            <div class="col-md-9 ">
                <div class="mb-1">
                    <span style="font-size: 19px; font-weight: 600;">Tools</span>
                </div>
                <p style="font-size: 16px;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                </p>
            </div>
            <div class="col-md-3">
                <div class="prod-back-div" style="width: 100%; height: 246px; background-image: url('{{ asset('img/svg/Online_shopping.svg') }}');"></div>
            </div>
        </div>
    
        <div class="row">
            <div class="account-menu-break"></div>
        </div>


        <div class="row" style="padding: 24px 32px 32px 32px;">
            <div class="text-center w-100">
                <span style="font-size: 19px; font-weight: 600;">Have Any Doubts?</span>
                <br>
                <a style="padding: .375rem .75rem; height: 30px;"  href="{{ route('support') }}" class="btn btn-info mt-3">CONTACT US</a>
            </div>
        </div>
    
    </div>


</div>
@endsection