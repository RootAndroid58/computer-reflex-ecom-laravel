@if (isMobile())

@include('mobile.index')

{{ die }}
@endif

@extends('layouts.common', ['page' => 'home'])

@section('title', 'Home')

@section('modals')

@endsection

@section('content')

@livewire('basic-helper')

<div class="">

    <div class="pl-200 pr-200  clearfix">
        <div class="categori-menu-slider-wrapper clearfix">
            @include('includes.home-all-departments')
            <div class="menu-slider-wrapper">
                @include('includes.home-main-drop-down-menu')
                <div class="slider-area">
                    <div class="slider-active owl-carousel">
                        @foreach ($banners as $banner)
                            @livewire('home-slider-banner', ['banner' => $banner], key('SmallBanner-'.$banner->id))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="electronic-banner-area">
        <div class="custom-row-2">
            @foreach ($SmallBanners as $key => $SmallBanner)
                @if ($key < 3)
                    @livewire('home-small-banner', ['SmallBanner' => $SmallBanner, 'type' => 'small'], key('SmallBanner-'.$SmallBanner->id))
                @endif
            @endforeach
        </div>
    </div>

    @foreach ($sections as $key => $section)
        @if ($sections->count()/2 > $key)
            @include('includes.home-page-products-carousel')
        @endif
    @endforeach

    @if (isset($SmallBanners[3]))
        @livewire('home-small-banner', ['SmallBanner' => $SmallBanners[3], 'type' => 'wide'], key('SmallBanner-'.$SmallBanners[3]->id))
    @endif
    
    
    @foreach ($sections as $key => $section)
        @if ($sections->count()/2 <= $key)
            @include('includes.home-page-products-carousel')
        @endif
    @endforeach


    {{-- @livewire('top-products-section') --}}


    @if (isset($SmallBanners[4]))
        @livewire('home-small-banner', ['SmallBanner' => $SmallBanners[4], 'type' => 'wide'], key('SmallBanner-'.$SmallBanners[4]->id))
    @endif
    
    
    <div class="product-area-2 wrapper-padding pb-70">
        <div class="container-fluid">
            <div class="section-title-4 text-center mb-60">
                <h2>Best Selling</h2>
            </div>
            <div class="row">
                @foreach ($BestSellingProducts as $product)
                    @livewire('best-selling-section', ['product' => $product], key($product->id))
                @endforeach
            </div>
        </div>
    </div>

    <div class="brand-logo-area-2 wrapper-padding ptb-80">
        <div class="container-fluid">
            <div class="brand-logo-active2 owl-carousel">
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/8.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/9.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/10.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/11.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/12.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/13.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img loading=lazy src="ezone/img/brand-logo/8.png" alt="">
                </div>
            </div>
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
        });
    }
    </script>
@endsection