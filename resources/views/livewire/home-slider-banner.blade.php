<div>
    @if (!isset($banner->banner_header) || !isset($banner->banner_header_2) || !isset($banner->banner_btn_txt) || !isset($banner->banner_caption))
    <a href="{{ $banner->banner_btn_link }}" class="w-100">
        <div class="single-slider single-slider-hm3 bg-img w-100" style="height: 600px; background-image: url({{ asset('storage/images/banner/'.$banner->banner_img) }})"></div>
    </a>
    @else
        <div class="single-slider single-slider-hm3 bg-img pt-170 pb-173 w-100" style="height: 600px; background-image: url({{ asset('storage/images/banner/'.$banner->banner_img) }})">
            <div class="slider-animation slider-content-style-3 fadeinup-animated">
                <h2 class="animated">{{ $banner->banner_header }}<br>{{ $banner->banner_header_2 }}</h2>
                <h4 class="animated">{{ $banner->banner_caption }} </h4>
                <a class="electro-slider-btn btn-hover" href="{{ $banner->banner_btn_link }}">{{ $banner->banner_btn_txt }}</a>
            </div>
        </div>
    @endif
</div>
    
