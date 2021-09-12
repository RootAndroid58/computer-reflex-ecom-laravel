@if (isMobile())

@include('mobile.index')

{{ die }}
@endif

@extends('layouts.common', ['page' => 'home'])

@section('title', 'Home')

@section('modals')
<!-- Modal -->
<div class="modal fade" id="SmallBannerEditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Small Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form class="w-100" action="{{ route('admin-edit-small-banner-submit') }}" method="post"> @csrf
                <div class="modal-body">
                    <div class="w-100">
                        <input required type="hidden" name="id" id="small_banner_id">
                        

                        <div class="form-group">
                        <label for="small_banner_url">Banner Link</label>
                        <input required type="url" class="form-control" name="link" id="small_banner_link" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="small_banner_image">Image URL</label>
                            <input required type="url" class="form-control" name="image" id="small_banner_img" aria-describedby="helpId" placeholder="">
                                <small class="text-muted">Get URL from <a href="https://imgbb.com" target="_blank">(https://imgbb.com)</a></small>
                            </div>

                        <div class="mt-3">
                            <p>Suggested Image Size: <span style="font-weight: 600" id="small_banner_suggested_size"></span></p>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>    
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
                            @livewire('home-slider-banner', ['banner' => $banner], key($banner->id))
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
                    @livewire('home-small-banner', ['SmallBanner' => $SmallBanner], key($SmallBanner->id))
                @endif
            @endforeach
        </div>
    </div>

    @foreach ($sections as $key => $section)
        @if ($sections->count()/2 > $key)
            @include('includes.home-page-products-carousel')
        @endif
    @endforeach

    @livewire('home-wide-banner', ['SmallBanner' => $SmallBanners[3]], key($user->id))
    
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


    @livewire('home-wide-banner', ['SmallBanner' => $SmallBanners[4]], key($user->id))
    
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