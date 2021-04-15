<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Computer Reflex - Online Shopping</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="ezone/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('ezone/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/icofont.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('ezone/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <script src="{{ asset('ezone/js/vendor/modernizr-2.8.3.min.js')}}"></script>


</head>

<body>

<!-- Button trigger modal -->


    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- header start -->
    <!--Notification Section-->
    @if (!Auth::check())
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


    


    <header>
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
                                <li><a href="{{route('orders')}}">My Orders</a></li>
                                <li><a href="{{route('wishlist')}}">My Wishlists</a></li>
                                <li><a href="{{ route('logout')}}">Logout</a></li>
                            </ul>
                            </li>
                        @endif
                        
                        
                        <li><a href="{{route('support')}}"><i class="pe-7s-headphones"></i>Support</a></li>
                        <li><a href="{{ route('wishlist') }}"><i class="pe-7s-like"></i>Wishlist</a></li>
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
                        <img src="{{ asset('ezone/img/logo/logo.png')}}" alt="">
                    </a>
                </div>



                <div class="categories-search-wrapper">
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
                            <input name="search" type="text" placeholder="Enter Your key word">
                            <button type="submit"> Search </button>
                        </form>
                    </div>
                </div>




                <div class="trace-cart-wrapper">
                    <div class="categories-cart same-style">
                        <div class="same-style-icon">
                            <a href="{{ route('cart') }}"><i class="pe-7s-cart"></i></a>
                        </div>
                        <div class="same-style-text">
                            <a href="{{ route('cart') }}">My Cart <br>
                                @if (Auth::check())
                                {{ App\Models\Cart::where('user_id', Auth()->user()->id)->get()->count() }} 
                                @else
                                {{ App\Models\SessionCart::where('session_id', Session::getId())->get()->count() }}
                                @endif
                                
                                
                                Item</a>
                        </div>
                    </div>
                </div>
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
    <!-- header end -->

<div class="body-container">


    <div class="pl-200 pr-200 overflow clearfix">
        <div class="categori-menu-slider-wrapper clearfix">
            <div class="categories-menu">
                <div class="category-heading">
                    <h3> All Departments <i class="pe-7s-angle-down"></i></h3>
                </div>
                <div class="category-menu-list">
                    <ul>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/5.png">Computer & Laptops <i class="pe-7s-angle-right"></i></a>
                            <div class="category-menu-dropdown">
                                <div class="category-dropdown-style category-common4 mb-40">
                                    <h4 class="categories-subtitle"> Desktop</h4>
                                    <ul>
                                        <li><a href="#"> Mother Board</a></li>
                                        <li><a href="#"> Power Supply</a></li>
                                        <li><a href="#"> RAM</a></li>
                                        <li><a href="#"> Graphics Card</a></li>
                                        <li><a href="#"> Hard Disk Drive</a></li>
                                        <li><a href="#">Cooling Fan</a></li>
                                        <li><a href="#">HD Cable</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common4 mb-40">
                                    <h4 class="categories-subtitle"> Laptop</h4>
                                    <ul>
                                        <li><a href="#">HP</a></li>
                                        <li><a href="#">lenovo</a></li>
                                        <li><a href="#"> vivo</a></li>
                                        <li><a href="#">   Mack Book Air</a></li>
                                        <li><a href="#"> Mack Book Pro</a></li>
                                        <li><a href="#"> LG</a></li>
                                        <li><a href="#"> Others Brand</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common4 mb-40">
                                    <h4 class="categories-subtitle">Others</h4>
                                    <ul>
                                        <li><a href="#">Monitor</a></li>
                                        <li><a href="#">Mouse</a></li>
                                        <li><a href="#">Keybord</a></li>
                                        <li><a href="#">Speaker</a></li>
                                        <li><a href="#">Joy Stick</a></li>
                                        <li><a href="#">Wireless Speaker</a></li>
                                        <li><a href="#">Software</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common4 mb-40">
                                    <h4 class="categories-subtitle">Accessories</h4>
                                    <ul class="border-none">
                                        <li><a href="#">Monitor</a></li>
                                        <li><a href="#">Mouse</a></li>
                                        <li><a href="#">Keybord</a></li>
                                        <li><a href="#">Speaker</a></li>
                                        <li><a href="#">Joy Stick</a></li>
                                        <li><a href="#">Wireless Speaker</a></li>
                                        <li><a href="#">Software</a></li>
                                    </ul>
                                </div>
                                <div class="mega-banner-img">
                                    <a href="single-product.html">
                                        <img src="{{ asset('ezone/img/banner/1.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/6.png">Phone & Tablets <i class="pe-7s-angle-right"></i></a>
                            <div class="category-menu-dropdown">
                                <div class="category-dropdown-style category-common4">
                                    <h4 class="categories-subtitle"> Desktop</h4>
                                    <ul>
                                        <li><a href="#"> Mother Board</a></li>
                                        <li><a href="#"> Power Supply</a></li>
                                        <li><a href="#"> RAM</a></li>
                                        <li><a href="#"> Graphics Card</a></li>
                                        <li><a href="#"> Hard Disk Drive</a></li>
                                        <li><a href="#">Cooling Fan</a></li>
                                        <li><a href="#">HD Cable</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common4">
                                    <h4 class="categories-subtitle"> Laptop</h4>
                                    <ul>
                                        <li><a href="#">HP</a></li>
                                        <li><a href="#">lenovo</a></li>
                                        <li><a href="#"> vivo</a></li>
                                        <li><a href="#">   Mack Book Air</a></li>
                                        <li><a href="#"> Mack Book Pro</a></li>
                                        <li><a href="#"> LG</a></li>
                                        <li><a href="#"> Others Brand</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common4">
                                    <h4 class="categories-subtitle">Others</h4>
                                    <ul>
                                        <li><a href="#">Monitor</a></li>
                                        <li><a href="#">Mouse</a></li>
                                        <li><a href="#">Keybord</a></li>
                                        <li><a href="#">Speaker</a></li>
                                        <li><a href="#">Joy Stick</a></li>
                                        <li><a href="#">Wireless Speaker</a></li>
                                        <li><a href="#">Software</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common4">
                                    <h4 class="categories-subtitle">Accessories</h4>
                                    <ul class="border-none">
                                        <li><a href="#">Monitor</a></li>
                                        <li><a href="#">Mouse</a></li>
                                        <li><a href="#">Keybord</a></li>
                                        <li><a href="#">Speaker</a></li>
                                        <li><a href="#">Joy Stick</a></li>
                                        <li><a href="#">Wireless Speaker</a></li>
                                        <li><a href="#">Software</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/7.png"> Camera & Photos<i class="pe-7s-angle-right"></i></a>
                            <div class="category-menu-dropdown">
                                <div class="category-dropdown-style category-common3">
                                    <h4 class="categories-subtitle"> Desktop</h4>
                                    <ul>
                                        <li><a href="#"> Mother Board</a></li>
                                        <li><a href="#"> Power Supply</a></li>
                                        <li><a href="#"> RAM</a></li>
                                        <li><a href="#"> Graphics Card</a></li>
                                        <li><a href="#"> Hard Disk Drive</a></li>
                                        <li><a href="#">Cooling Fan</a></li>
                                        <li><a href="#">HD Cable</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common3">
                                    <h4 class="categories-subtitle"> Laptop</h4>
                                    <ul>
                                        <li><a href="#">HP</a></li>
                                        <li><a href="#">lenovo</a></li>
                                        <li><a href="#"> vivo</a></li>
                                        <li><a href="#">   Mack Book Air</a></li>
                                        <li><a href="#"> Mack Book Pro</a></li>
                                        <li><a href="#"> LG</a></li>
                                        <li><a href="#"> Others Brand</a></li>
                                    </ul>
                                </div>
                                <div class="category-dropdown-style category-common3">
                                    <h4 class="categories-subtitle">Others</h4>
                                    <ul class="border-none">
                                        <li><a href="#">Monitor</a></li>
                                        <li><a href="#">Mouse</a></li>
                                        <li><a href="#">Keybord</a></li>
                                        <li><a href="#">Speaker</a></li>
                                        <li><a href="#">Joy Stick</a></li>
                                        <li><a href="#">Wireless Speaker</a></li>
                                        <li><a href="#">Software</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/8.png">TV & Audio </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/9.png"> Game & Play Station</a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/10.png"> Car Electronics </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/11.png"> Accessories </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/12.png"> Gadgets</a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="ezone/img/icon-img/13.png">Others Equipment</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu-slider-wrapper">
                <div class="menu-style-3 menu-hover text-center">
                    <nav>
                        <ul>
                            <li><a href="{{ url('/') }}">home <i class="pe-7s-angle-down"></i> <span class="sticker-new">hot</span></a>
                                <ul class="single-dropdown">
                                    <li><a href="{{ url('/') }}">Fashion</a></li>
                                    <li><a href="index-fashion-2.html">Fashion style 2</a></li>
                                    <li><a href="index-fruits.html">fruits</a></li>
                                    <li><a href="index-book.html">book</a></li>
                                    <li><a href="index-electronics.html">electronics</a></li>
                                    <li><a href="index-electronics-2.html">electronics style 2</a></li>
                                    <li><a href="index-food.html">food & drink</a></li>
                                    <li><a href="index-furniture.html">furniture</a></li>
                                    <li><a href="index-handicraft.html">handicraft</a></li>
                                    <li><a target="_blank" href="index-smart-watch.html">smart watch</a></li>
                                    <li><a href="index-sports.html">sports</a></li>
                                </ul>
                            </li>
                            <li><a href="#">pages </a>
                                <ul class="single-dropdown">
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
                            <li><a href="shop.html">shop <i class="pe-7s-angle-down"></i> <span class="sticker-new">hot</span></a>
                                <div class="category-menu-dropdown shop-menu">
                                    <div class="category-dropdown-style category-common2 mb-30">
                                        <h4 class="categories-subtitle"> shop layout</h4>
                                        <ul>
                                            <li><a href="shop-grid-2-col.html"> grid 2 column</a></li>
                                            <li><a href="shop-grid-3-col.html"> grid 3 column</a></li>
                                            <li><a href="shop.html">grid 4 column</a></li>
                                            <li><a href="shop-grid-box.html">grid box style</a></li>
                                            <li><a href="shop-list-1-col.html"> list 1 column</a></li>
                                            <li><a href="shop-list-2-col.html">list 2 column</a></li>
                                            <li><a href="shop-list-box.html">list box style</a></li>
                                            <li><a href="{{ route('cart') }}">shopping cart</a></li>
                                            <li><a href="{{ route('wishlist') }}">wishlist</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-dropdown-style category-common2 mb-30">
                                        <h4 class="categories-subtitle"> product details</h4>
                                        <ul>
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
                                    </div>
                                    <div class="mega-banner-img">
                                        <a href="single-product.html">
                                            <img src="ezone/img/banner/1.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li><a href="blog.html">blog <i class="pe-7s-angle-down"></i> <span class="sticker-new">hot</span></a>
                                <ul class="single-dropdown">
                                    <li><a href="blog.html">blog 3 colunm</a></li>
                                    <li><a href="blog-2-col.html">blog 2 colunm</a></li>
                                    <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                    <li><a href="blog-details.html">blog details</a></li>
                                    <li><a href="blog-details-sidebar.html">blog details 2</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('support')}}">contact</a></li>
                        </ul>
                    </nav>
                </div>








{{-- Banner Slider Area Start --}}
<div class="slider-area">
    <div class="slider-active owl-carousel">
@foreach ($banners as $banner)
        <div class="single-slider single-slider-hm3 bg-img pt-170 pb-173" style="background-image: url({{ 'storage/images/banner/'.$banner->banner_img }})">
            <div class="slider-animation slider-content-style-3 fadeinup-animated">
                <h2 class="animated">{{ $banner->banner_header }}<br>{{ $banner->banner_header_2 }}</h2>
                <h4 class="animated">{{ $banner->banner_caption }} </h4>
                <a class="electro-slider-btn btn-hover" href="{{ $banner->banner_btn_link }}">{{ $banner->banner_btn_txt }}</a>
            </div>
        </div>
@endforeach
    </div>
</div>
{{-- Banner Slider Area End --}}




            </div>
        </div>
    </div>
    <div class="electronic-banner-area">
        <div class="custom-row-2">

            <div class="custom-col-style-2 electronic-banner-col-3 mb-30">
                <a href="{{ route('show-catalog', 'antec-cabinets') }}">
                    <div class="electronic-banner-wrapper">
                        <img src="https://i.ibb.co/g6Jj344/antec-cabinet-430x275px.jpg" alt="">
                    </div>
                </a>
            </div>

            <div class="custom-col-style-2 electronic-banner-col-3 mb-30">
                <a href="{{ route('show-catalog', 'antec-smps-reliability-meets-affordablitiy') }}">
                    <div class="electronic-banner-wrapper">
                        <img src="https://i.ibb.co/p0qpfff/antec-smps-430x275px.jpg" alt="">
                    </div>
                </a>
            </div>

            <div class="custom-col-style-2 electronic-banner-col-3 mb-30">
                <a href="{{ route('show-catalog', 'antec-case-fans-beat-the-heat-with-style') }}">
                    <div class="electronic-banner-wrapper">
                        <img src="https://i.ibb.co/NsZbVXj/antec-case-fans-430x275px.jpg" alt="">
                    </div>
                </a>
            </div>

        </div>
    </div>






    @foreach ($sections as $key => $section)
        @if ($sections->count()/2 > $key)
            @include('includes.home-page-products-carousel')
        @endif
    @endforeach






























    <div class="banner-area wrapper-padding pt-30 pb-50">
        <div class="container-fluid">
            <a href="#">
                <img src="https://i.ibb.co/cXbFqhn/asus-z590-series-1920x400px-1920x400.webp" alt="" width="100%">
            </a>
        </div>
    </div>
    
















<div class="electro-product-wrapper wrapper-padding pt-30 pb-45">
    <div class="container-fluid">
        <div class="section-title-4 text-center mb-40">
            <h2>Top Products</h2>
        </div>
        <div class="top-product-style">
            <div class="product-tab-list3 text-center mb-80 nav product-menu-mrg" role="tablist">
                <a class="" href="#topProducts1" data-toggle="tab" role="tab" aria-selected="false">
                    <h4>Graphics Cards </h4>
                </a>
                <a href="#topProducts2" data-toggle="tab" role="tab" class="active" aria-selected="true">
                    <h4>Processors </h4>
                </a>
                <a href="#topProducts3" data-toggle="tab" role="tab" class="" aria-selected="false">
                    <h4>Motherboards</h4>
                </a>
            </div>
            <div class="tab-content">

                {{-- topProducts1 section --}}
                <div class="tab-pane fade" id="topProducts1" role="tabpanel">
                    <div class="custom-row-2">
                        @foreach ($topProducts1 as $product)
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="{{ route('product-index', $product->id) }}" >
                                        <div class="prod-back-div" style="width: 100%; height: 175px; background-image: url('{{asset('storage/images/products/'.$product->images[0]->image)}}');"></div>
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" title="Quick View" href="#" >
                                            <i class="pe-7s-repeat"></i>
                                        </a>
                                        <a class="animate-top cursor-pointer" title="Add To Cart" onclick="ToggleCart({{ $product->id }})">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left cursor-pointer" title="Wishlist" onclick="ToggleWishlist({{ $product->id }})">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
                                    </div>
                                    <h4><a href="{{ route('product-index', $product->id) }}" class="line-limit-2">{{$product->product_name}}</a></h4>
                                    <span>
                                        <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>₹</s></font><s> 35,799</s></span> <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ ((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100 }}% off</b>
                                    </span>
                                    <h5><font class="rupees">₹</font>{{ moneyFormatIndia($product->product_price) }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- topProducts2 section --}}
                <div class="tab-pane fade active show" id="topProducts2" role="tabpanel">
                    <div class="custom-row-2">
                        @foreach ($topProducts2 as $product)
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="{{ route('product-index', $product->id) }}" >
                                        <div class="prod-back-div" style="width: 100%; height: 175px; background-image: url('{{asset('storage/images/products/'.$product->images[0]->image)}}');"></div>
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" title="Quick View" href="#" >
                                            <i class="pe-7s-repeat"></i>
                                        </a>
                                        <a class="animate-top cursor-pointer" title="Add To Cart" onclick="ToggleCart({{ $product->id }})">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left cursor-pointer" title="Wishlist" onclick="ToggleWishlist({{ $product->id }})">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        
                                  
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
                                        

                                        

                                    </div>
                                    <h4><a href="{{ route('product-index', $product->id) }}" class="line-limit-2">{{$product->product_name}}</a></h4>
                                    <span>
                                        <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>₹</s></font><s> 35,799</s></span> <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ ((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100 }}% off</b>
                                    </span>
                                    <h5><font class="rupees">₹</font>{{ moneyFormatIndia($product->product_price) }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
                

                {{-- topProducts3 section --}}
                <div class="tab-pane fade" id="topProducts3" role="tabpanel">
                    <div class="custom-row-2">

                        @foreach ($topProducts3 as $product)
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="{{ route('product-index', $product->id) }}" >
                                        <div class="prod-back-div" style="width: 100%; height: 175px; background-image: url('{{asset('storage/images/products/'.$product->images[0]->image)}}');"></div>
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" title="Quick View" href="#" >
                                            <i class="pe-7s-repeat"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        
                                  
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
                                        

                                        

                                    </div>
                                    <h4><a href="{{ route('product-index', $product->id) }}" class="line-limit-2">{{$product->product_name}}</a></h4>
                                    <span>
                                        <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>₹</s></font><s> 35,799</s></span> <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ ((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100 }}% off</b>
                                    </span>
                                    <h5><font class="rupees">₹</font>{{ moneyFormatIndia($product->product_price) }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>



            </div>
        </div>
    </div>
</div>









@foreach ($sections as $key => $section)
    @if ($sections->count()/2 <= $key)
        @include('includes.home-page-products-carousel')
    @endif
@endforeach












<div class="banner-area wrapper-padding pt-30 pb-50">
    <div class="container-fluid">
        <a href="http://localhost:8000/product/6">
            <img src="https://i.ibb.co/9txw7hX/lancool-215.webp" alt="" width="100%">
        </a>
    </div>
</div>











    
    <div class="product-area-2 wrapper-padding pb-70">
        <div class="container-fluid">
            <div class="section-title-4 text-center mb-60">
                <h2>Best Selling</h2>
            </div>
            <div class="row">
                @foreach ($BestSellingProducts as $BestSellingProduct)
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="{{route('product-index', $BestSellingProduct->id)}}">
                                <div class="prod-back-div" style="width: 100%; height: 100%; background-image: url('{{ asset('storage/images/products/'.$BestSellingProduct->images[0]->image) }}')"></div>
                            </a>
                        </div>

                        <div class="product-content-7">
                            <h4><a href="{{route('product-index', $BestSellingProduct->id)}}" class="line-limit-2">{{$BestSellingProduct->product_name}}</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star @if (isset($BestSellingProduct->stars->stars) && $BestSellingProduct->stars->stars >= 1) yellow @endif "></i>
                                <i class="icofont icofont-star @if (isset($BestSellingProduct->stars->stars) && $BestSellingProduct->stars->stars >= 2) yellow @endif "></i>
                                <i class="icofont icofont-star @if (isset($BestSellingProduct->stars->stars) && $BestSellingProduct->stars->stars >= 3) yellow @endif "></i>
                                <i class="icofont icofont-star @if (isset($BestSellingProduct->stars->stars) && $BestSellingProduct->stars->stars >= 4) yellow @endif "></i>
                                <i class="icofont icofont-star @if (isset($BestSellingProduct->stars->stars) && $BestSellingProduct->stars->stars >= 5) yellow @endif "></i>
                            </div>
                            <h5><font class="rupees">₹</font>{{moneyFormatIndia($BestSellingProduct->product_price)}}</h5>
                            <div class="product-action-electro">
                                <a class="animate-top cursor-pointer" title="Add To Cart" onclick="ToggleCart({{ $BestSellingProduct->id }})">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left cursor-pointer" title="Wishlist" onclick="ToggleWishlist({{ $BestSellingProduct->id }})">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="brand-logo-area-2 wrapper-padding ptb-80">
        <div class="container-fluid">
            <div class="brand-logo-active2 owl-carousel">
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/8.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/9.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/10.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/11.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/12.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/13.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="ezone/img/brand-logo/8.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="newsletter-area ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="section-title-5">
                        <h2>Newsletter</h2>
                        <p>Sign Up for get all update news & Get <span>Exciting Discounts</span></p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="newsletter-style-3">
                        <div id="mc_embed_signup" class="subscribe-form-3 pr-50">
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
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>


    <footer class="footer-area">
        <div class="footer-top-3 black-bg pt-75 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xl-4">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-3">Contact Us</h3>
                            <div class="footer-info-wrapper-2">
                                <div class="footer-address-electro">
                                    <div class="footer-info-icon2">
                                        <span>Address:</span>
                                    </div>
                                    <div class="footer-info-content2">
                                        <p>77 Seventh Streeth Banasree
                                            <br>Road Rampura -2100 Dhaka</p>
                                    </div>
                                </div>
                                <div class="footer-address-electro">
                                    <div class="footer-info-icon2">
                                        <span>Phone:</span>
                                    </div>
                                    <div class="footer-info-content2">
                                        <p>+11 (019) 2518 4203
                                            <br>+11 (251) 2223 3353</p>
                                    </div>
                                </div>
                                <div class="footer-address-electro">
                                    <div class="footer-info-icon2">
                                        <span>Email:</span>
                                    </div>
                                    <div class="footer-info-content2">
                                        <p><a href="#">domain@mail.com</a>
                                            <br><a href="#">company@domain.info</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-xl-3">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-3">My Account</h3>
                            <div class="footer-widget-content-3">
                                <ul>
                                    <li><a href="login.html">Login Hare</a></li>
                                    <li><a href="{{ route('cart') }}">Cart History</a></li>
                                    <li><a href="checkout.html"> Payment History</a></li>
                                    <li><a href="shop.html">Product Tracking</a></li>
                                    <li><a href="register.html">Register</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-xl-2">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-3">Information</h3>
                            <div class="footer-widget-content-3">
                                <ul>
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="#">Our Service</a></li>
                                    <li><a href="#">Pricing Plan</a></li>
                                    <li><a href="#"> Vendor Detail</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-xl-3">
                        <div class="footer-widget widget-right mb-40">
                            <h3 class="footer-widget-title-3">Service</h3>
                            <div class="footer-widget-content-3">
                                <ul>
                                    <li><a href="#">Product Service</a></li>
                                    <li><a href="#">Payment Service</a></li>
                                    <li><a href="#"> Discount Service</a></li>
                                    <li><a href="#">Shopping Service</a></li>
                                    <li><a href="#">Promotional Add</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle black-bg-2 pt-35 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-services-wrapper mb-30">
                            <div class="footer-services-icon">
                                <i class="pe-7s-car"></i>
                            </div>
                            <div class="footer-services-content">
                                <h3>Free Shipping</h3>
                                <p>Free Shipping on Bangladesh</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-services-wrapper mb-30">
                            <div class="footer-services-icon">
                                <i class="pe-7s-shield"></i>
                            </div>
                            <div class="footer-services-content">
                                <h3>Money Guarentee</h3>
                                <p>Free Shipping on Bangladesh</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-services-wrapper mb-30">
                            <div class="footer-services-icon">
                                <i class="pe-7s-headphones"></i>
                            </div>
                            <div class="footer-services-content">
                                <h3>Online Support</h3>
                                <p>Free Shipping on Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom  black-bg pt-25 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5">
                        <div class="footer-menu">
                            <nav>
                                <ul>
                                    <li><a href="#">Privacy Policy </a></li>
                                    <li><a href="blog.html"> Blog</a></li>
                                    <li><a href="#">Help Center</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="copyright f-right mrg-5">
                            <p>
                                Copyright ©
                                <a href="https://hastech.company/">HasTech</a> 2018 . All Right Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- modal -->
    <div class="modal fade" id="exampleCompare" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="pe-7s-close" aria-hidden="true"></span>
        </button>
        <div class="modal-dialog modal-compare-width" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="#">
                        <div class="table-content compare-style table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            <a href="#">Remove <span>x</span></a>
                                            <img src="ezone/img/cart/4.jpg" alt="">
                                            <p>Blush Sequin Top </p>
                                            <span>$75.99</span>
                                            <a class="compare-btn" href="#">Add to cart</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Description </h4></td>
                                        <td class="compare-dec compare-common">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has beenin the stand ard dummy text ever since the 1500s, when an unknown printer took a galley</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Sku </h4></td>
                                        <td class="product-none compare-common">
                                            <p>-</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Availability  </h4></td>
                                        <td class="compare-stock compare-common">
                                            <p>In stock</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Weight   </h4></td>
                                        <td class="compare-none compare-common">
                                            <p>-</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>Dimensions   </h4></td>
                                        <td class="compare-stock compare-common">
                                            <p>N/A</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>brand   </h4></td>
                                        <td class="compare-brand compare-common">
                                            <p>HasTech</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>color   </h4></td>
                                        <td class="compare-color compare-common">
                                            <p>Grey, Light Yellow, Green, Blue, Purple, Black </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title">
                                            <h4>size    </h4></td>
                                        <td class="compare-size compare-common">
                                            <p>XS, S, M, L, XL, XXL </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="compare-title"></td>
                                        <td class="compare-price compare-common">
                                            <p>$75.99 </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="pe-7s-close" aria-hidden="true"></span>
        </button>
        <div class="modal-dialog modal-quickview-width" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="qwick-view-left">
                        <div class="quick-view-learg-img">
                            <div class="quick-view-tab-content tab-content">
                                <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                    <img src="ezone/img/quick-view/l1.jpg" alt="">
                                </div>
                                <div class="tab-pane fade" id="modal2" role="tabpanel">
                                    <img src="ezone/img/quick-view/l2.jpg" alt="">
                                </div>
                                <div class="tab-pane fade" id="modal3" role="tabpanel">
                                    <img src="ezone/img/quick-view/l3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="quick-view-list nav" role="tablist">
                            <a class="active" href="#modal1" data-toggle="tab" role="tab">
                                <img src="ezone/img/quick-view/s1.jpg" alt="">
                            </a>
                            <a href="#modal2" data-toggle="tab" role="tab">
                                <img src="ezone/img/quick-view/s2.jpg" alt="">
                            </a>
                            <a href="#modal3" data-toggle="tab" role="tab">
                                <img src="ezone/img/quick-view/s3.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="qwick-view-right">
                        <div class="qwick-view-content">
                            <h3>Handcrafted Supper Mug</h3>
                            <div class="price">
                                <span class="new">$90.00</span>
                                <span class="old">$120.00  </span>
                            </div>
                            <div class="rating-number">
                                <div class="quick-view-rating">
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                </div>
                                <div class="quick-view-number">
                                    <span>2 Ratting (S)</span>
                                </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do tempor incididun ut labore et dolore magna aliqua. Ut enim ad mi , quis nostrud veniam exercitation .</p>
                            <div class="quick-view-select">
                                <div class="select-option-part">
                                    <label>Size*</label>
                                    <select class="select">
                                        <option value="">- Please Select -</option>
                                        <option value="">900</option>
                                        <option value="">700</option>
                                    </select>
                                </div>
                                <div class="select-option-part">
                                    <label>Color*</label>
                                    <select class="select">
                                        <option value="">- Please Select -</option>
                                        <option value="">orange</option>
                                        <option value="">pink</option>
                                        <option value="">yellow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="quickview-plus-minus">
                                <div class="cart-plus-minus">
                                    <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                </div>
                                <div class="quickview-btn-cart">
                                    <a class="btn-hover-black" href="#">add to cart</a>
                                </div>
                                <div class="quickview-btn-wishlist">
                                    <a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- all js here -->
    <script src="{{ asset('ezone/js/vendor/jquery-1.12.0.min.js')}}"></script>
    <script src="{{ asset('ezone/js/popper.js')}}"></script>
    <script src="{{ asset('ezone/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('ezone/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('ezone/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('ezone/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('ezone/js/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('ezone/js/waypoints.min.js')}}"></script>
    <script src="{{ asset('ezone/js/ajax-mail.js')}}"></script>
    <script src="{{ asset('ezone/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/jquery.bootstrap-growl.min.js')}}"></script>
    <script src="{{ asset('ezone/js/plugins.js')}}"></script>
    <script src="{{ asset('ezone/js/main.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>

<script>
function ToggleWishlist(product_id) {

$.ajax({
    url: "{{route('toggle-wishlist-btn')}}",
    method: 'POST',
    data: {
        'product_id' : product_id,
    },
    success: function (data) {

        if (data == 500) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Removed from wishlist.", {
                type: "danger",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else if(data == 200) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Added to wishlist.", {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        }
    }
})

}

function ToggleCart(product_id) {

    $.ajax({
    url: "{{route('toggle-cart-btn')}}",
    method: 'POST',
    data: {
        'product_id' : product_id,
    },
    success: function (data) {

        if (data == 200) {
            $('#CartCount').load("{{ route('cart') }} #CartCount")
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Added To Cart.", {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else if(data == 500) {
            $('#CartCount').load("{{ route('cart') }} #CartCount")
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Removed From Cart.", {
                type: "danger",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        }
    }
})

}



</script>

</body>

</html>