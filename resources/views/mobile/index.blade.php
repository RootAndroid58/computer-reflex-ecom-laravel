@extends('layouts.mobile-common')

@section('title', 'Home')



@section('css-js')
    
@endsection



    
@section('content')


{{-- Categories Carousel Start --}}
<div class="brand-logo-area-2 wrapper-padding mt-3 mb-3 no-before no-after">
    <div class="w-100">
        <div class="brand-logo-active2 owl-carousel">
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/all-categories.jpg')}}" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/graphic-cards.png')}}" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/hdds.png')}}" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="{{asset('img/categories/ssds.png')}}" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="ezone/img/brand-logo/11.png" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="ezone/img/brand-logo/12.png" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="ezone/img/brand-logo/13.png" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="ezone/img/brand-logo/7.png" alt="">
            </div>
            <div class="single-brand">
                <img style="width: 60px; height: 57px;" loading=lazy src="ezone/img/brand-logo/8.png" alt="">
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
            <div style="height: 200px; display: table;" class="slider-animation slider-content-style-3 fadeinup-animated">
                <div style="display: table-cell; vertical-align: middle;">
                    <h5 class="animated">{{ $banner->banner_header }}<br>{{ $banner->banner_header_2 }}</h5>
                    <h6 style="font-size: 13px;" class="animated">{{ WordLimit($banner->banner_caption, 3) }}<br>{{ WordLimitBypass($banner->banner_caption, 3) }}</h6>
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
    <div class="custom-row-2 row">
        @foreach ($SmallBanners as $key => $SmallBanner)
            @if ($key < 3)
            <div class="col-12 mb-2" style="padding-left: 1px; padding-right: 1px;">
                <div class="div-shadow">
                    <a href="{{ $SmallBanner->link }}">
                        <div class="electronic-banner-wrapper">
                            <img style="height: 100%; width: 100%;" loading=lazy src="{{ $SmallBanner->image }}" alt="Small Banner Image">
                        </div>
                    </a>
                </div>
            </div>
            @endif
        @endforeach
    </div>

@endsection
    


@section('bottom-js')
    
@endsection
    