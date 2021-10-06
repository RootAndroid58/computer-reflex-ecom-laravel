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
    
    {{-- Home Hero Section --}}
    <div class="pl-200 pr-200  clearfix">
        <div class="categori-menu-slider-wrapper clearfix" style="padding-bottom: 20px;">
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


    {{-- All Dynamic Home Compoents --}}
    @livewire('home.home-components', key('HomeComponents'))




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