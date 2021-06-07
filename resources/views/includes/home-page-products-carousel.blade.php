<div class="electronic-banner-area @if (!isMobile()) mb-5 @else mb-2 @endif  ">
    <div class="row">
        <div class="col-12" style="padding: 0;">
            <div class="bbb_main_container">
                <div class="bbb_viewed_title_container" >
                    <h3 class="bbb_viewed_title" style="margin-bottom: 5px; @if (isMobile()) font-size: 20px; @endif">{{$section->title}} 
                        @if (!isMobile())
                            @canany(['Manage UI', 'Master Admin'])
                            <a style="font-size: 14px;" class="static-blue" target="_blank" href="{{ route('admin-edit-home-carousel-slider', $section->id) }}">Edit</a>
                            @endcanany
                        @endif
                    </h3>
                    <div class="bbb_viewed_nav_container float-right" style="position: unset;">
                        <div class="bbb_viewed_nav bbb_viewed_prev" onclick="PrevCarousel({{ $section->id }})"><i class="fas fa-chevron-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next" onclick="NextCarousel({{ $section->id }})"><i class="fas fa-chevron-right"></i></div>
                    </div>
                    <div class="mb-2">
                        <span >{{$section->caption}}</span>
                    </div>
                </div>
                
                <div class="bbb_viewed_slider_container ">
                    <div class=" owl-carousel owl-carousel-{{ $section->id }} owl-theme bbb_viewed_slider">
                        @foreach ($section->SectionProducts as $SectionProduct)
                            @if (isset($SectionProduct->product))
                                @livewire('carousel-products', ['product' => $SectionProduct->product], key($SectionProduct->product->id))
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>