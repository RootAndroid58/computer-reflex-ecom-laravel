
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title') - {{ Config::get('app.name') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico')}}">

        @include('includes.top-includes')

        @yield('css-js')
        <style>
            .body-container{
                background-color: #f1f3f6;
                padding-top: 14px;
            }
            .rupees{
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>

    </head>
    <body >

        @yield('modals')

        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- header start -->

        @if (!Auth::check() && isset($page) && $page == 'home')
        <div class="notification-section notification-section-padding  notification-img ptb-10">
            <div class="container-fluid">
                <div class="notification-wrapper">
                    <div class="notification-pera-graph">
                        <p>Please login first for best browsing experience.</p>
                    </div>
                    <div class="notification-btn-close">
                        <div class="notification-btn">
                            <a href="{{ route('login') }}">Login Now</a>
                        </div>
                        <div class="notification-close notification-icon">
                            <button><i class="pe-7s-close"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif



        {{-- Home Page header --}}
        @if (isset($page) && $page == 'home') 
        <header class="main-header-home">
            <div class="header-top-wrapper-2 border-bottom-2">
                <div class="header-info-wrapper pl-200 pr-200">
                    <div class="header-contact-info">
                        <ul>
                            <li><i class="pe-7s-call"></i><a href="tel:+91 7003373754">+91 7003 373 754</a></li>
                            <li><i class="pe-7s-mail"></i><a href="mailto:contact@computer-reflex.tk">contact@computer-reflex.tk</a></li>
                        </ul>
                    </div>
                    <div class="electronics-login-register">
                        <ul>
                            @if (!Auth::check())
                                <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>Login</a></li>
                            @else

                            @can('Admin')
                                <li><a href="{{route('admin-dashboard')}}"><i class="fal fa-desktop-alt"></i> Admin</a>
                            @endcan
                                <li><a href="{{route('my-account')}}"><i class="pe-7s-users"></i>My Account</a>
                                <ul>
                                    <li><a href="{{route('my-account')}}">My Account</a></li>
                                    <li><a href="{{route('orders')}}">My Orders</a></li>
                                    <li><a href="{{route('wishlist')}}">My Wishlist</a></li>
                                    <li><a href="{{ route('logout')}}">Logout</a></li>
                                </ul>
                                </li>
                            @endif
                            <li><a href="{{route('support')}}"><i class="pe-7s-headphones"></i>Support</a></li>
                            <li><a href="{{ route('wishlist') }}"><i class="pe-7s-like"></i>Wishlist</a></li>
                            <li><a href="{{ route('compare') }}"><i class="pe-7s-repeat"></i>Compare</a></li>
                            <li><a href="#"><i class="pe-7s-flag"></i>IN</a></li>
                            <li><a class="border-none" href="#"><span><font class="rupees">₹</font> </span>INR</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-bottom pt-40 pb-30 clearfix">
                <div class="header-bottom-wrapper pr-200 pl-200">
                    <div class="logo-3">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/grey.gif') }}" data-src="{{ asset('ezone/img/logo/logo.png')}}" alt="">
                        </a>
                    </div>



                    <div class="categories-search-wrapper ">
                        <div class="all-categories">
                            <div class="select-wrapper">
                                <select class="select" id="CategorySelect">
                                    <option value="all">All Categories</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->category}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="categories-wrapper">
                            <form action="{{route('search')}}" method="GET">
                                <input name="category" id="CategoryInput" type="hidden" value="all">
                                <input name="search" type="text" placeholder="Enter Your key word" maxlength="120">
                                <button type="submit"> Search </button>
                            </form>
                        </div>
                    </div>

                    @livewire('cart-count', ['page' => 'home'])

                    <div class="mobile-menu-area electro-menu d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul class="menu-overflow">
                                    <li><a href="#">HOME</a>
                                        <ul>
                                            <li><a href="{{ url('/') }}">Fashion</a></li>
                                            <li><a href="index-fashion-2.html">Fashion style 2</a></li>
                                            <li><a href="index-fruits.html">Fruits</a></li>
                                            <li><a href="index-book.html">book</a></li>
                                            <li><a href="index-electronics.html">electronics</a></li>
                                            <li><a href="index-electronics-2.html">electronics style 2</a></li>
                                            <li><a href="index-food.html">food & drink</a></li>
                                            <li><a href="index-furniture.html">furniture</a></li>
                                            <li><a href="index-handicraft.html">handicraft</a></li>
                                            <li><a href="index-smart-watch.html">smart watch</a></li>
                                            <li><a href="index-sports.html">sports</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">pages</a>
                                        <ul>
                                            <li><a href="about-us.html">about us</a></li>
                                            <li><a href="menu-list.html">menu list</a></li>
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="register.html">register</a></li>
                                            <li><a href="{{ route('cart') }}">cart page</a></li>
                                            <li><a href="checkout.html">checkout</a></li>
                                            <li><a href="{{ route('wishlist') }}">wishlist</a></li>
                                            <li><a href="{{route('support')}}">contact</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">shop</a>
                                        <ul>
                                            <li><a href="shop-grid-2-col.html"> grid 2 column</a></li>
                                            <li><a href="shop-grid-3-col.html"> grid 3 column</a></li>
                                            <li><a href="shop.html">grid 4 column</a></li>
                                            <li><a href="shop-grid-box.html">grid box style</a></li>
                                            <li><a href="shop-list-1-col.html"> list 1 column</a></li>
                                            <li><a href="shop-list-2-col.html">list 2 column</a></li>
                                            <li><a href="shop-list-box.html">list box style</a></li>
                                            <li><a href="product-details.html">tab style 1</a></li>
                                            <li><a href="product-details-2.html">tab style 2</a></li>
                                            <li><a href="product-details-3.html"> tab style 3</a></li>
                                            <li><a href="product-details-4.html">sticky style</a></li>
                                            <li><a href="product-details-5.html">sticky style 2</a></li>
                                            <li><a href="product-details-6.html">gallery style</a></li>
                                            <li><a href="product-details-7.html">gallery style 2</a></li>
                                            <li><a href="product-details-8.html">fixed image style</a></li>
                                            <li><a href="product-details-9.html">fixed image style 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">BLOG</a>
                                        <ul>
                                            <li><a href="blog.html">blog 3 colunm</a></li>
                                            <li><a href="blog-2-col.html">blog 2 colunm</a></li>
                                            <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                            <li><a href="blog-details.html">blog details</a></li>
                                            <li><a href="blog-details-sidebar.html">blog details 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('support')}}"> Contact  </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Others Page Header --}}
        @else
        <header>
            <div class="header-top-furniture wrapper-padding-2 res-header-sm">
                <div class="container-fluid">
                    <div class="header-bottom-wrapper">

                        {{-- Website Logo --}}
                        <div class="logo-2 furniture-logo ptb-30">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('img/grey.gif') }}" data-src="{{ asset('ezone/img/logo/logo.png')}}" alt="">
                            </a>
                        </div>

                        <div class="menu-style-2 furniture-menu menu-hover">
                            @php
                                $AllCategories = App\Models\Category::get();
                            @endphp
                            <nav>
                                <ul>    
                                    <li><a href="{{url('/')}}">home</a>
                                    </li>
                                    <li><a href="#">Categories</a>
                                        <ul class="single-dropdown">
                                            @foreach ($AllCategories as $AllCategories)
                                                <li><a href="{{ route('search', ['category' => $AllCategories->category]) }}">{{$AllCategories->category}}</a></li>  
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="#">New Releases</a>
                                    </li>
                                    <li><a href="#">blog</a>
                                        <ul class="single-dropdown">
                                            <li><a href="blog.html">blog 3 colunm</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('support')}}">support</a></li>
                                </ul>
                            </nav>
                        </div>


                        {{-- Header Cart Button --}}
                        @livewire('cart-count')


                    </div>

                    {{-- Mobile Menu --}}
                    <div class="row">
                        <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul class="menu-overflow">
                                        <li><a href="#">HOME</a>
                                            <ul>
                                                <li><a href="{{ route('home') }}">Fashion</a></li>
                                                <li><a href="index-fashion-2.html">Fashion style 2</a></li>
                                                <li><a href="index-fruits.html">Fruits</a></li>
                                                <li><a href="index-book.html">book</a></li>
                                                <li><a href="index-electronics.html">electronics</a></li>
                                                <li><a href="index-electronics-2.html">electronics style 2</a></li>
                                                <li><a href="index-food.html">food & drink</a></li>
                                                <li><a href="index-furniture.html">furniture</a></li>
                                                <li><a href="index-handicraft.html">handicraft</a></li>
                                                <li><a href="index-smart-watch.html">smart watch</a></li>
                                                <li><a href="index-sports.html">sports</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">pages</a>
                                            <ul>
                                                <li><a href="about-us.html">about us</a></li>
                                                <li><a href="menu-list.html">menu list</a></li>
                                                <li><a href="login.html">login</a></li>
                                                <li><a href="register.html">register</a></li>
                                                <li><a href="{{ route('cart') }}">cart page</a></li>
                                                <li><a href="checkout.html">checkout</a></li>
                                                <li><a href="wishlist.html">wishlist</a></li>
                                                <li><a href="contact.html">contact</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">shop</a>
                                            <ul>
                                                <li><a href="shop-grid-2-col.html"> grid 2 column</a></li>
                                                <li><a href="shop-grid-3-col.html"> grid 3 column</a></li>
                                                <li><a href="shop.html">grid 4 column</a></li>
                                                <li><a href="shop-grid-box.html">grid box style</a></li>
                                                <li><a href="shop-list-1-col.html"> list 1 column</a></li>
                                                <li><a href="shop-list-2-col.html">list 2 column</a></li>
                                                <li><a href="shop-list-box.html">list box style</a></li>
                                                <li><a href="product-details.html">tab style 1</a></li>
                                                <li><a href="product-details-2.html">tab style 2</a></li>
                                                <li><a href="product-details-3.html"> tab style 3</a></li>
                                                <li><a href="product-details-4.html">sticky style</a></li>
                                                <li><a href="product-details-5.html">sticky style 2</a></li>
                                                <li><a href="product-details-6.html">gallery style</a></li>
                                                <li><a href="product-details-7.html">gallery style 2</a></li>
                                                <li><a href="product-details-8.html">fixed image style</a></li>
                                                <li><a href="product-details-9.html">fixed image style 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">BLOG</a>
                                            <ul>
                                                <li><a href="blog.html">blog 3 colunm</a></li>
                                                <li><a href="blog-2-col.html">blog 2 colunm</a></li>
                                                <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                                <li><a href="blog-details.html">blog details</a></li>
                                                <li><a href="blog-details-sidebar.html">blog details 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html"> Contact  </a></li>
                                    </ul>
                                </nav>							
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            {{-- Bottom Header --}}
            <div class="header-bottom-furniture wrapper-padding-2 border-top-3">
                <div class="container-fluid">
                    <div class="furniture-bottom-wrapper">

                        @if (Auth::check())
                            <div class="furniture-login menu-hover">
                                <nav>
                                    <ul >
                                        <li>Hello,  <a href="{{ route('my-account')}}">{{ FirstWord(Auth()->user()->name) }}</a></li>
                                        <li>        <a href="{{ route('my-account')}}">Account</a>
                                            <ul class="single-dropdown" style="margin-top: 15px;">
                                                <li class="no-before"><a href="{{ route('my-account')}}">My Account</a></li>
                                                <li class="no-before"><a href="{{ route('orders')}}">My Orders</a></li>
                                                <li class="no-before"><a href="{{ route('wishlist')}}">My Wishlist</a></li>
                                                <li class="no-before"><a href="{{ route('support')}}">Support</a></li>
                                                <li class="no-before"><a href="{{ route('logout')}}">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @else 
                            <div class="furniture-login">
                                <ul>
                                    <li><a href="{{ route('login') }}">Login </a></li>
                                    <li><a href="{{ route('register') }}">Sign Up </a></li>
                                </ul>
                            </div>
                        @endif


                        {{-- Search Bar --}}
                        <div class="furniture-search">
                            <form method="GET" action="{{ route('search') }}">
                                <input placeholder="I am Searching for . . ." maxlength="120" type="text" value="{{ request()->search ?? '' }}" name="search">
                                <input type="hidden" name="min_price" value="{{ request()->min_price ?? '0' }}">
                                <input type="hidden" name="max_price" value="{{ request()->max_price ?? '' }}">
                                <input type="hidden" name="stock" value="{{ request()->stock ?? '' }}">
                                <button>
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Right side buttons container --}}
                        <div class="furniture-wishlist">
                            <ul>
                                <li><a href="{{ route('compare')}}"><i class="pe-7s-repeat"></i> Compare</a></li>
                                <li><a href="{{ route('wishlist')}}"><i class="ti-heart"></i> Wishlist</a></li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </header>
        <!-- header end --> 

        @endif
    

        

        @yield('content')




        {{-- Footer --}}
		<footer class="footer-area">
            <div class="footer-top-area bg-img pt-105 pb-65" style="background-image: url({{ asset('ezone/img/bg/1.jpg') }})" data-overlay="9">
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

		
    
    @include('includes.bottom-includes')

    @yield('bottom-js')

    </body>
</html>
