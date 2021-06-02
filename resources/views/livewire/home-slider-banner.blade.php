<div wire:init='DocReady'>
    @if ($isReady)
        @if (!isset($banner->banner_header) || !isset($banner->banner_header_2) || !isset($banner->banner_btn_txt) || !isset($banner->banner_caption))
            <a href="">
                <div class="single-slider single-slider-hm3 bg-img pt-170 pb-173" style="background-image: url({{ 'storage/images/banner/'.$banner->banner_img }})">
                    <div class="slider-animation slider-content-style-3 fadeinup-animated">
                        <h2 class="animated">&nbsp;<br>&nbsp;</h2>
                        <h4 class="animated">&nbsp;</h4>
                        <span style="line-height: 1; padding: 15px 40px 14px; display: inline-block;">&nbsp;</span>
                    </div>
                </div>
            </a>
        @else
            <div class="single-slider single-slider-hm3 bg-img pt-170 pb-173" style="background-image: url({{ 'storage/images/banner/'.$banner->banner_img }})">
                <div class="slider-animation slider-content-style-3 fadeinup-animated">
                    <h2 class="animated">{{ $banner->banner_header }}<br>{{ $banner->banner_header_2 }}</h2>
                    <h4 class="animated">{{ $banner->banner_caption }} </h4>
                    <a class="electro-slider-btn btn-hover" href="{{ $banner->banner_btn_link }}">{{ $banner->banner_btn_txt }}</a>
                </div>
            </div>
        @endif
    @endif
</div>
