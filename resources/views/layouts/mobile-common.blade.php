<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico')}}">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('ezone/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('ezone/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/pe-icon-7-stroke.css')}}">
    
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}">
    
    <link rel="stylesheet" href="{{ asset('css/star-rating.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/icofont.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/easyzoom.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('ezone/css/bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('css/collapse-bs4.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css')}}">
    <script src="{{ asset('ezone/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    @yield('css-js')

    <style>
        .header {
                width: 100%;
            
                text-align:center;
                color: #3a3a3a;
                top: 0px;
            }
        </style>
</head>


<body>



    


    <div style="min-height: 90vh;">
        @yield('content')
        <h1>Hello World</h1>
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
    <script src="{{ asset('ezone/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('ezone/js/popper.js') }}"></script>
    <script src="{{ asset('ezone/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ezone/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('ezone/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('ezone/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('ezone/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('ezone/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('ezone/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('ezone/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ezone/js/plugins.js') }}"></script>
    <script src="{{ asset('ezone/js/main.js') }}"></script>
    <script src="{{ asset('js/zoomsl.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easyzoom-modified.min.js') }}"></script>
    <script src="{{ asset('js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap-growl.min.js')}}"></script>
    <script src="{{ asset('ezone/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/star-rating.js?ver=4.1.2')}}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    @yield('bottom-js')
    <script>
    $("#header-scroll").hide();
    $(window).scroll(function() {
      if ($(this).scrollTop() > 10) {
        $('#header-scroll').slideDown(500);
        $('#header-full').slideUp(500);
      } else {
        $('#header-scroll').slideUp(500);
        $('#header-full').slideDown(500);
      }
    }); 
    </script>
      

</body>
</html>