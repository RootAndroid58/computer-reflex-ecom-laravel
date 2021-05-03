<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#343a40">

    <title>@yield('title') - {{ env('APP_NAME') }}</title>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-STJZ4CTNF7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-STJZ4CTNF7');
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico')}}">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('ezone/css/bootstrap.min.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('ezone/css/magnific-popup.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/animate.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/owl.carousel.min.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/themify-icons.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/pe-icon-7-stroke.css')}}?{{ env('ASSET_VER') }}">
    
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}?{{ env('ASSET_VER') }}">
    
    <link rel="stylesheet" href="{{ asset('css/star-rating.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/icofont.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/meanmenu.min.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/easyzoom.css')}}?{{ env('ASSET_VER') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('ezone/css/bundle.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/style.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('ezone/css/responsive.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('css/collapse-bs4.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}?{{ env('ASSET_VER') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css')}}?{{ env('ASSET_VER') }}">
    <script src="{{ asset('ezone/js/vendor/modernizr-2.8.3.min.js')}}?{{ env('ASSET_VER') }}"></script>
    @yield('css-js')

    <style>
            .vertical-align-content {
                background-color:#f18c16;
                height: 52px;
                display:flex;
                align-items:center;
                /* Uncomment next line to get horizontal align also */
                /* justify-content:center; */
                }
        </style>
</head>


<body>

@yield('modals')
    
<div id="SearchScreen" class="search-screen d-none" style="height: 100vh; width: 100%; position: fixed; z-index: 19" >
   <input type="hidden" id="FetchSearchSuggestionsUrl" value="{{ route('fetch-search-suggestions') }}">
   <input type="hidden" id="Url" value="{{ url('/') }}">
    

        <form action="{{route('search')}}" method="GET">
            <div class="row">
                    <div class="col-2" style="padding-right: 0;">
                        <button type="button" class="btn btn-block btn-dark " id="SearchScreeenToggleBtn" style="height: 100%; " ><i class="far fa-window-close"></i></button>
                    </div>
                    <div class="col-8" style="padding: 0;">
                        <div class="form-group" style="margin: 0;">
                            <input type="text" style="height: 100%; border-radius: 0;"
                            class="form-control" name="search" id="SearchMobileInput" aria-describedby="helpId" placeholder="Search Here...">
                        </div>
                    </div>
                    <div class="col-2" style="padding-left: 0;">
                        <button type="submit" class="btn btn-block btn-info" style="height: 100%; " ><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>



    <ul id="MobileSearchOptions" style="background-color: white;"></ul>

</div>



<div id="burgerMenuWrapper" class="burger-menu-wrapper w-100" style="visibility: hidden; z-index: 11; opacity: 0; position: fixed; height: 100%; background: rgba(0,0,0,.6);">
    <div id="burgerNavMenu" class="burger-nav-menu w-75" style="position: fixed; z-index: 10; left: -75%;">
        <div style="height: 100vh;">
            
            <div class="w-100 bg-dark pt-3" style="height: 225px;">

                <div class="prod-back-div user-img-container mt-3" 
                style="margin-left: auto; margin-right: auto; width: 100px; height: 100px; border-radius: 50%; 
                    @if(Auth::check())
                    background-image: url({{ asset('storage/images/dp/'.Auth()->user()->dp) }})
                    @else
                    background-image: url({{ asset('storage/images/dp/default.png') }})
                    @endif
                "></div>
                
                <div class="w-100 mt-3 pb-2" style="color: white; text-align: center;" >
                    <div>
                        {!! GreetUser() !!}
                    </div>
                    <div>
                       
                        <span class="font-weight-bold">{{ FirstWord(Auth()->user()->name ?? 'Guest' ) }}</span>
                      
                        @if (!Auth::check())
                        <div class="mt-2 pb-2">
                            <a href="{{ route('login') }}" style="font-weight: 600; color: rgb(221, 221, 221);">LOGIN</a>
                            <span style="color: rgb(119, 119, 119);">|</span> 
                            <a href="{{ route('register') }}" style="font-weight: 600; color: rgb(221, 221, 221);" >SIGNUP</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


            {{-- To activate highlight add class to the Li( account-menu-item-active ) --}}

            <div class="mobile-nav-category-container">

                    
                <ul class="mt-3">
                    <li class="@yield('burger-home-menu')">
                        <span class="li-icon"><i class="fas fa-home-lg-alt"></i></span>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
    
                    <li class="@yield('burger-shop-by-categories-menu')">
                        <span class="li-icon"><i class="fas fa-th"></i></span>
                        <a href="{{ route('categories') }}">Shop By Category</a>
                    </li>
                </ul>


                <ul class="mt-3">
                    <li class="@yield('burger-my-account-menu')">
                        <span class="li-icon"><i class="fas fa-user"></i></span>
                        <a href="{{ route('my-account') }}">My Account</a>
                    </li>

                    <li class="@yield('burger-my-orders-menu')">
                        <span class="li-icon"><i class="fad fa-box-check"></i></span>
                        <a href="{{ route('orders') }}">My Orders</a>
                    </li>
    
                    <li class="@yield('burger-shopping-cart-menu')">
                        <span class="li-icon"><i class="fas fa-shopping-cart"></i></span>
                        <a href="{{ route('cart') }}">Shopping Cart</a>
                    </li>
    
                    <li class="@yield('burger-my-wishlist-menu')">
                        <span class="li-icon"><i class="fas fa-heart"></i></span> 
                        <a href="{{ route('wishlist') }}">My Wishlist</a>
                    </li>

                    <li class="@yield('burger-my-addresses-menu')">
                        <span class="li-icon"><i class="fas fa-address-card"></i></span> 
                        <a href="{{ route('addresses') }}">My Addresses</a>
                    </li>
    
                    <li class="@yield('burger-compare-menu')">
                        <span class="li-icon"><i class="fas fa-repeat-alt"></i></span> 
                        <a href="{{ route('compare') }}">Compare</a>
                    </li>
                </ul>
    
    
                <ul class="mt-3">
                    @if (Auth::check() && Auth()->user()->can('Affiliate'))
                    <li class="@yield('burger-affiliate-purchases-menu')">
                        <span class="li-icon"><i class="fad fa-envelope-open-text"></i></span>
                        <a href="{{ route('affiliate.referred-purchases') }}">Affiliate Purchases</a>
                    </li>
    
                    <li class="@yield('burger-affiliate-wallet-menu')">
                        <span class="li-icon"><i class="fas fa-user-headset"></i></span>
                        <a href="{{ route('affiliate.wallet') }}">Affiliate Wallet</a>
                    </li>
                    @else
                    <li class="@yield('burger-join-affiliate-menu')">
                        <span class="li-icon"><i class="fas fa-sack-dollar"></i></span>
                        <a href="{{ route('affiliate.join') }}">Join Affiliate</a>
                    </li>
                    @endif
                    
                </ul>
    
                <ul class="mt-3">
                    <li class="@yield('burger-raise-support-ticket-menu')">
                        <span class="li-icon"><i class="fas fa-ticket-alt"></i></span>
                        <a href="{{ route('support.raise-support-ticket') }}">Raise Support Ticket</a>
                    </li>
    
                    <li class="@yield('burger-support-tickets-menu')">
                        <span class="li-icon"><i class="fad fa-envelope-open-text"></i></span>
                        <a href="{{ route('support.support-tickets') }}">Support Tickets</a>
                    </li>
    
                    <li class="@yield('burger-contact-us-menu')">
                        <span class="li-icon"><i class="fas fa-user-headset"></i></span>
                        <a href="{{ route('support.contact-us') }}">Contact Info</a>
                    </li>
                </ul>
    
                <ul class="mt-3">
                    <li class="@yield('burger-about-us-menu')">
                        <span class="li-icon"><i class="fas fa-file-certificate"></i></span>
                        <a href="{{ route('my-account') }}">About Us</a>
                    </li>
    
                    <li class="@yield('burger-privacy-policy-menu')">
                        <span class="li-icon"><i class="fas fa-user-lock"></i></span>
                        <a href="{{ route('cart') }}">Privacy Policy</a>
                    </li>
    
                    <li class="@yield('burger-terms-of-use-menu')">
                        <span class="li-icon"><i class="fas fa-route-interstate"></i></span>
                        <a href="{{ route('cart') }}">Terms Of Use</a>
                    </li>
    
                    <li class="@yield('burger-return-policy-menu')">
                        <span class="li-icon"><i class="fas fa-truck"></i></span>
                        <a href="{{ route('cart') }}">Return & Replacement Policy</a>
                    </li>
                </ul>
                <div style="padding: 25px;" class="mt-3">
                    <img src="{{ asset('img/svg/video_game_night.svg') }}" alt="" style="width: 100%;">
                </div>
            </div>
           


        </div>
    </div>
</div>



    <header id="" class="w-100">
        <div  id="main-header">
            <div class="w-100 bg-dark main-header-top vertical-align-content" style="min-height: 52px; padding: 0px 15px;">
                <div class="w-100" style="    display: table; table-layout: fixed; width: 100%; min-height: 52px; height: 52px;">
                    <a class="burgerMenuBtn"  onclick="toggleBurgerMenu()" style="font-size: 19px; line-height: base-line; color: #fff; display: table-cell; vertical-align: middle;
                        text-align: center;
                        width: 20%;
                        width: 42px;
                        max-height: 16px;
                        line-height: 10px;
                        position: relative;
                        overflow: hidden;" >
                        <i class="fas fa-bars"></i>
                    </a>

                    <a style="
                    display: table-cell;
                    vertical-align: middle;
                    height: 28px;
                    overflow: hidden;
                    line-height: 10px;
                    max-width: 111px;
                    padding-top: 2px;
                    position: relative;
                    " href="{{ url('/') }}">
                        <img src="{{ asset('img/logo-white-text.png') }}" style="width: 100px; height: 30px;" alt="">
                    </a>

                    <a style="
                        font-size: 19px;
                        color: #fff;
                        display: table-cell;
                        vertical-align: middle;
                        text-align: center;
                        width: 20%;
                        width: 42px;
                        max-height: 16px;
                        line-height: 10px;
                        position: relative;
                        overflow: hidden;
                    " href="{{ route('wishlist') }}">
                        <i class="fad fa-heart"></i>
                    </a>

                    <a style="
                        font-size: 19px;
                        color: #fff;
                        display: table-cell;
                        vertical-align: middle;
                        text-align: center;
                        width: 20%;
                        width: 42px;
                        max-height: 16px;
                        line-height: 10px;
                        position: relative;
                        overflow: hidden;
                    " href="{{ route('cart') }}">
                        <i class="fad fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="w-100 bg-dark" style="min-height: 0px; padding: 0px 15px 15px 15px;">
            <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fad fa-search"></i></span>
                </div>
                <input type="text" class="form-control search-input" aria-label="Username" aria-describedby="basic-addon1" placeholder="Search for Products...">
            </div>
        </div>

        @yield('header-extra')
    </header>


    <header id="scroll-header" class="w-100"  style="position: fixed; top: -52px; z-index: 10; transition: 300ms;">

                <div class="w-100 bg-dark main-header-top vertical-align-content" style="min-height: 52px; padding: 0px 10px;">
                    <a class="burgerMenuBtn"  onclick="toggleBurgerMenu()" style="line-height: base-line; font-size: 19px; color: white;">
                         <i class="fas fa-bars"></i>
                     </a>

                     <div class="w-100" style="line-height: base-line; font-size: 19px; color: white; padding-left: 10px;">
                        <div class="input-group w-100">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fad fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control search-input" aria-label="Username" aria-describedby="basic-addon1" placeholder="Search for Products...">
                        </div>
                     </div>

                     <div class="" style="padding-left: 10px;">
                        <a  style="font-size: 19px; color: white;">
                            <i class="fad fa-shopping-cart"></i>
                        </a>
                     </div>
                 </div>    
                 
                @yield('header-extra')
    </header>
    


    <div style="min-height: 90vh;">
        @yield('content')
        
    </div>

    

        {{-- Footer --}}
		<footer class="footer-area">
            <div class="footer-top-area bg-img pt-105 pb-65" style="background-image: url(ezone/img/bg/1.jpg)" data-overlay="9">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-3">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Custom Service</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                        <li><a href="{{ route('cart') }}">Cart</a></li>
                                        <li><a href="{{ route('my-account')}}">My Account</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Track</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-3">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Categories</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                        <li><a href="shop.html">Dress</a></li>
                                        <li><a href="shop.html">Shoes</a></li>
                                        <li><a href="shop.html">Shirt</a></li>
                                        <li><a href="shop.html">Baby Product</a></li>
                                        <li><a href="shop.html">Mans Product</a></li>
                                        <li><a href="shop.html">Leather</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Contact</h3>
                                <div class="footer-newsletter">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is dummy.</p>
                                    <div id="mc_embed_signup" class="subscribe-form pr-40">
                                        <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input type="email" value="" name="EMAIL" class="email" placeholder="Enter Your E-mail" required>
                                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                <div class="mc-news" aria-hidden="true">
                                                    <input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value="">
                                                </div>
                                                <div class="clear">
                                                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer-contact">
                                        <p><span><i class="ti-location-pin"></i></span> 77 Seventh avenue USA 12555. </p>
                                        <p><span><i class=" ti-headphone-alt "></i></span> +88 (015) 609735 or +88 (012) 112266</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom black-bg ptb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="copyright">
                                <p>
                                    Copyright ©
                                    <a href="{{url('')}}">Computer Reflex</a> 2021 . All Right Reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        


    <!-- all js here -->
    <script src="{{ asset('ezone/js/vendor/jquery-1.12.0.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/popper.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/bootstrap.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/jquery.magnific-popup.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/isotope.pkgd.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/imagesloaded.pkgd.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/jquery.counterup.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/waypoints.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/ajax-mail.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/owl.carousel.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/plugins.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/main.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('js/zoomsl.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('js/jquery.easyzoom-modified.min.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('js/summernote-bs4.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap-growl.min.js')}}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('ezone/js/owl.carousel.min.js')}}?{{ env('ASSET_VER') }}"></script>
    <script src="{{ asset('js/star-rating.js?ver=4.1.2')}}?{{ env('ASSET_VER') }}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="{{ asset('js/main.js') }}?{{ env('ASSET_VER') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    @yield('bottom-js')

       
<script>


    $(document).click(function(e) { 
        var $target = $(e.target);
        if(!$target.closest('#burgerNavMenu').length && $('#burgerMenuWrapper').css('visibility') == 'visible') {
            toggleBurgerMenu()
        }        
    });

    $('#SearchMobileInput').on('keyup', function () {

        $.ajax({
            url: $('#FetchSearchSuggestionsUrl').val(),
            method: 'GET',
            data: {
                search: $(this).val(),
            },
            success: function (data) {
                if (data.status == 200) {
                    console.log(data.products);
                    $('#MobileSearchOptions').html('')
                    var url = $('#Url').val();
                    data.products.forEach(product => {
                        $('#MobileSearchOptions').append(`
                        <a href="${url}/product/${product.id}">
                            <div class="container-fluid">
                                <div class="row" style="padding-top: 10px;">
                                    <div class="col-3">
                                        <img style="display: block; margin:auto; width: 100%; height: auto;" src="${url}/storage/images/products/${product.images[0].image}">
                                    </div>
                                    <div class="col-7 " style="padding: 0;">
                                        <span class="line-limit-2">${product.product_name}</span>
                                    </div>
                                    <div class="col-2" >
                                        <span><i class="fad fa-location-arrow"></i></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        `)
                    });
                

                }
            }
        })
    })
        


     // Toggle function for Mobile Slide Out Burger Menu
    function toggleBurgerMenu() {
        if ($('#burgerMenuWrapper').css('opacity') == '0') {
            $('#burgerMenuWrapper').css('opacity', '1');
            $('#burgerMenuWrapper').css('visibility', 'visible');
            $('#burgerNavMenu').css('left', "0%");
            $('#burgerNavMenu').css('transition', "all 300ms ease");
            $('body').css('overflow', 'hidden');
        } else {
            $('#burgerMenuWrapper').css('opacity', '0');
            $('#burgerMenuWrapper').css('visibility', 'hidden');
            $('#burgerNavMenu').css('left', "-75%");
            $('#burgerNavMenu').css('transition', "all 300ms ease");
            $('body').css('overflow', 'unset');
        }
    }
     // Toggle function for Mobile Slide Out Burger Menu


    $('.search-input').on('focus', function () {
        SearchScreenToggle()
    })
    $('#SearchScreeenToggleBtn').on('click', function () {
        SearchScreenToggle()
    })


    function SearchScreenToggle() {
        if ($('#SearchScreen').hasClass('d-none')) {
            $('#SearchScreen').removeClass('d-none');
            $('#scrollUp').addClass('d-none');
            $('#SearchMobileInput').focus();
            $('body').css('overflow', 'hidden');
        } else { 
            $('#SearchScreen').addClass('d-none');
            $('body').css('overflow', 'unset');
            $('#scrollUp').removeClass('d-none');
        }
    }



        // On scroll swap to the right Header
        $(window).scroll(function() {
            SwitchHeaders()
        });
        
        $(document).ready(function () {
            SwitchHeaders()
        })

        function SwitchHeaders() {
            if ($(this).scrollTop() > $('#main-header').innerHeight() + $('#scroll-header').innerHeight() / 2 ) {
                $('#scroll-header').css('top', '0');
            } else {
                $('#scroll-header').css('top', "-"+$('#scroll-header').innerHeight()+"px");
            }
        }

      
    </script>
      

</body>
</html>