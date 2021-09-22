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
                                @livewire('top-products-section', ['product' => $product], key($product->id))
                            @endforeach
                        </div>
                    </div>
                    {{-- topProducts2 section --}}
                    <div class="tab-pane fade active show" id="topProducts2" role="tabpanel">
                        <div class="custom-row-2">
                            @foreach ($topProducts2 as $product)
                                @livewire('top-products-section', ['product' => $product], key($product->id))
                            @endforeach
                        </div>
                    </div>
                    {{-- topProducts3 section --}}
                    <div class="tab-pane fade" id="topProducts3" role="tabpanel">
                        <div class="custom-row-2">
                            @foreach ($topProducts3 as $product)
                                @livewire('top-products-section', ['product' => $product], key($product->id))
                            @endforeach
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

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