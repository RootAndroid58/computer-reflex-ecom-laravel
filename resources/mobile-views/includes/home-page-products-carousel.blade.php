<div class="electronic-banner-area mb-5">
    <div class="row">
        <div class="col-12">
            <div class="bbb_main_container">
                <div class="bbb_viewed_title_container" >
                    <h3 class="bbb_viewed_title" style="margin-bottom: 5px;">{{$section->title}} 
                        <a style="font-size: 14px;" class="static-blue" target="_blank" href="{{ route('admin-edit-home-carousel-slider', $section->id) }}">Edit</a>
                    </h3>
                    <div class="mb-2">
                        <span >{{$section->caption}}</span>
                    </div>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev" onclick="PrevCarousel({{ $section->id }})"><i class="fas fa-chevron-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next" onclick="NextCarousel({{ $section->id }})"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
                <div class="bbb_viewed_slider_container">
                    <div class="owl-carousel owl-carousel-{{ $section->id }} owl-theme bbb_viewed_slider">
                        @foreach ($section->SectionProducts as $product)
                        @php
                           $product = $product->product;
                        @endphp
                        <div class="owl-item">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="{{route('product-index', $product->id)}}" target="_blank">
                                        <div class="sm-prod-img-container" style="background-image: url('{{ asset('storage/images/products/'.$product->images[0]->image) }}');"></div>
                                    </a>
                                    <div class="product-action">
                                        <a class="animate-left cursor-pointer" onclick="ToggleWishlist({{$product->id}})" title="Wishlist"><i class="pe-7s-like"></i></a>
                                        <a class="animate-top cursor-pointer" onclick="ToggleCart({{$product->id}})" title="Add To Cart"><i class="pe-7s-cart"></i></a>
                                        <a class="animate-right cursor-pointer" onclick="ToggleCompare({{$product->id}})" title="Compare"><i class="pe-7s-repeat"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h4><a class="line-limit-2" href="{{route('product-index', $product->id)}}"> {{$product->product_name}} </a></h4>
                                    <span><font class="rupees">₹</font> 
                                        {{ moneyFormatIndia($product->product_price) }}
                                        <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100}}% off</b>
                                    </span>
                                    @if ($product->product_stock <= 0)
                                        <br>
                                        <span class="text-danger">Out Of Stock</span>
                                    @endif
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