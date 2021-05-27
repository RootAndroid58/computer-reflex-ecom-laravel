@extends('layouts.mobile-common')

@section('title', 'Home')

@section('burger-home-menu', 'account-menu-item-active')


@section('css-js')
    
@endsection



    
@section('content')


{{-- Categories Carousel Start --}}
<div class="brand-logo-area-2 wrapper-padding mt-3 mb-3 no-before no-after">
    <div class="w-100">
        <div class="brand-logo-active2 owl-carousel">
            <div class="single-brand">
                <a href="">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/all-categories.jpg')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=Graphics+Card&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/graphic-cards.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=Hard+Disk&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/hdds.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=SSD&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/ssds.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=Power+Supply&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/power-supplies.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=RAM&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/rams.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=SSD&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/ssds.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=SSD&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/ssds.png')}}" alt="">
                </a>
            </div>
            <div class="single-brand">
                <a href="{{ url('search?category=SSD&search=') }}">
                    <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/ssds.png')}}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
{{-- Categories Carousel End --}}





{{-- Banner Slider Area Start --}}
<div class="slider-area">
    <div class="slider-active owl-carousel">
@foreach ($banners as $banner)
    @if (!isset($banner->banner_header) || !isset($banner->banner_header_2) || !isset($banner->banner_btn_txt) || !isset($banner->banner_caption))
        <a href="">
            <div class="single-slider single-slider-hm3 bg-img pt-170 pb-173" style="padding: 0; background-image: url({{ 'storage/images/banner/'.$banner->banner_img }})">
                <div style="height: 200px;" class="slider-animation slider-content-style-3 fadeinup-animated">
                    <h5 class="animated">&nbsp;<br>&nbsp;</h5>
                    <h6 class="animated">&nbsp;</h6>
                    <span style="line-height: 1; padding: 15px 40px 14px; display: inline-block;">&nbsp;</span>
                </div>
            </div>
        </a>
    @else
        <div class="single-slider single-slider-hm3 bg-img pt-170" style="padding: 0; background-image: url({{ 'storage/images/banner/'.$banner->banner_img }})">
            <div style="height: 200px; " class="d-flex align-items-center slider-animation slider-content-style-3 fadeinup-animated">
                <div>
                    <h2 style="font-size: 18px; line-height: 1.2;" class="animated">{{ $banner->banner_header }}<br>{{ $banner->banner_header_2 }}</h2>
                    <h4 style="font-size: 13px; margin-top: 8px;  margin-bottom: 8px;" class="animated">{{ WordLimit($banner->banner_caption, 3) }}<br>{{ WordLimitBypass($banner->banner_caption, 3) }}</h4>
                    <a style="padding: .25rem .5rem; font-size: 10px;" class="electro-slider-btn btn-hover" href="{{ $banner->banner_btn_link }}">{{ $banner->banner_btn_txt }}</a>
                </div>
            </div>
        </div>
    @endif
@endforeach
    </div>
</div>
{{-- Banner Slider Area End --}}








    
<div class="electronic-banner-area mt-5">
    <div class="row">
        @foreach ($SmallBanners as $key => $SmallBanner)
            @if ($key < 3)
            <div class="col-12 mb-2" style="padding-left: 0; padding-right: 0;">
               
                    <a href="{{ $SmallBanner->link }}" class="w-100">
                        <div class="electronic-banner-wrapper">
                            <img style="height: 100%; width: 100%;" loading=lazy src="{{ $SmallBanner->image }}" alt="Small Banner Image">
                        </div>
                    </a>
            
            </div>
            @endif
        @endforeach
    </div>
</div>




{{-- Products Carousel Slider Start --}}
@foreach ($sections as $key => $section)
    @if ($sections->count()/2 > $key)
        @include('includes.home-page-products-carousel')
    @endif
@endforeach
{{-- Products Carousel Slider End --}}


    
<div class="banner-area wrapper-padding mb-3">
    <div class="container-fluid">
        <div class="row">
            <a href="{{  $SmallBanners[3]->link  }}">
                <img loading=lazy src="{{  $SmallBanners[3]->image  }}" alt="Oops... Banner Image Not Loaded" width="100%">
            </a>
        </div>
       
        {{-- @canany(['Manage UI', 'Master Admin'])
        <div>
            <span class="cursor-pointer static-blue float-right"  onclick="EditSmallBanner({{  $SmallBanners[4]->id  }})">Edit</span>
        </div>
        @endcanany --}}
    </div>
</div>


{{-- Products Carousel Slider Start --}}
@foreach ($sections as $key => $section)
    @if ($sections->count()/2 <= $key)
        @include('includes.home-page-products-carousel')
    @endif
@endforeach
{{-- Products Carousel Slider End --}}




    







<div class="electro-product-wrapper wrapper-padding pt-30 pb-45">
    <div class="container-fluid">
        <div class="section-title-4 text-center mb-3">
            <h2>Top Products</h2>
        </div>
        <div class="top-product-style">
            <div class="product-tab-list3 text-center mb-2 nav product-menu-mrg" role="tablist">
                <a class="" href="#topProducts1" data-toggle="tab" role="tab" aria-selected="false">
                    <h4 style="font-size: 14px;">Graphics Cards </h4>
                </a>
                <a href="#topProducts2" data-toggle="tab" role="tab" class="active" aria-selected="true">
                    <h4  style="font-size: 11px;">Processors </h4>
                </a>
                <a href="#topProducts3" data-toggle="tab" role="tab" class="" aria-selected="false">
                    <h4  style="font-size: 11px;">Motherboards</h4>
                </a>
            </div>
            <div class="tab-content">

                {{-- topProducts1 section --}}
                <div class="tab-pane fade" id="topProducts1" role="tabpanel">
                    <div class="custom-row-2">
                        @foreach ($topProducts1 as $product)
                            @include('includes.top-products-section')
                        @endforeach
                    </div>
                </div>

                {{-- topProducts2 section --}}
                <div class="tab-pane fade active show" id="topProducts2" role="tabpanel">
                    <div class="custom-row-2">
                        @foreach ($topProducts2 as $product)
                            @include('includes.top-products-section')
                        @endforeach
                    </div>
                </div>
                

                {{-- topProducts3 section --}}
                <div class="tab-pane fade" id="topProducts3" role="tabpanel">
                    <div class="custom-row-2">
                        @foreach ($topProducts3 as $product)
                            @include('includes.top-products-section')
                        @endforeach
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>




<div class="banner-area wrapper-padding mb-3">
    <div class="container-fluid">
        <div class="row">
            <a href="{{  $SmallBanners[4]->link  }}">
                <img loading=lazy src="{{  $SmallBanners[4]->image  }}" alt="Oops... Banner Image Not Loaded" width="100%">
            </a>
        </div>
       
        {{-- @canany(['Manage UI', 'Master Admin'])
        <div>
            <span class="cursor-pointer static-blue float-right"  onclick="EditSmallBanner({{  $SmallBanners[4]->id  }})">Edit</span>
        </div>
        @endcanany --}}
    </div>
</div>













<div class="product-area-2 wrapper-padding pb-70 mt-5">
    <div class="container-fluid">
        <div class="section-title-4 text-center mb-60">
            <h2>Best Selling</h2>
        </div>
        <div class="row">
            @foreach ($BestSellingProducts as $BestSellingProduct)
            <div class="col-lg-6 col-6 col-xl-4" style="padding: 0;">
                <div class="product-wrapper product-wrapper-border" style="padding: 20px 20px 47px;">
                    <div class="product-img-5">
                        <a href="{{route('product-index', $BestSellingProduct->id)}}">
                            <div class="prod-back-div" style="width: 100%; height: 140px; background-image: url('{{ asset('storage/images/products/'.$BestSellingProduct->images[0]->image) }}')"></div>
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
                            <a class="animate-right cursor-pointer" title="Compare" onclick="ToggleCompare({{ $BestSellingProduct->id }})">
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

@endsection
    


@section('bottom-js')
    
<script>

    function EditSmallBanner(banner_id) {
    
    $.ajax({
      url: "{{ route('get-small-banner-data') }}",
      method: 'POST',
      data: {
          'banner_id' : banner_id,
      },
      success: function (data) {
        if (data.status != 500) {
            $('#small_banner_id').val(banner_id);
            $('#small_banner_img').val(data.SmallBanner.image);
            $('#small_banner_link').val(data.SmallBanner.link);
            $('#small_banner_suggested_size').html(data.size);
            $('#SmallBannerEditModal').modal('toggle');
        }
      }
    })
    }
    
    
    function ToggleCompare(product_id) {
    
    $.ajax({
        url: "{{route('toggle-compare-btn')}}",
        method: 'POST',
        data: {
            'product_id' : product_id,
        },
        success: function (data) {
            if (data.status == 500 || data.status == 200) {
                $(".bootstrap-growl").remove();
                $.bootstrapGrowl(data.msg, {
                    type: data.type,
                    offset: {from:"bottom", amount: 100},
                    align: 'center',
                    allow_dismis: true,
                    stack_spacing: 10,
                })
            }
        }
    })
    
    }
    
    
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
    
@endsection
    