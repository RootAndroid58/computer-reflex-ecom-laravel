@extends('layouts.common')

@section('title', $product->product_name)

@section('css-js')
    
@endsection

@section('content')

@php
    $counter = 1;
    $counter2 = 1;
    
    $est_dt = new DateTime();
    $est_dt->modify( '+10 days' );
@endphp

<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">


            {{-- Images section Start --}}
            <div class="col-md-12 col-lg-7 col-12">

                <div class="product_img_slider">
                    <!-- All Images list -->
                    <ul>
                        @foreach ($images as $image)
                        <li><img src="{{ asset('storage/images/products/'.$image->image) }}" class="small_img" alt=""></li>
                        @endforeach
                    </ul>
                
                    <!-- Big image area/canvas -->
                    <span class="vertically-aligned-span"></span><img src="{{ asset('storage/images/products/'.$images[0]->image) }}" class="big_img" alt="">
                </div>

                <div class="buy-now-btn-container">
                    <a href="#">Buy Now</a>
                </div>

            </div> {{-- Images section End --}}


            {{-- Product details start --}}
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">


                    <h3>{{$product->product_name}}</h3>
                    <div class="rating-number">
                        <div class="quick-view-rating">
                            <i class="pe-7s-star red-star"></i>
                            <i class="pe-7s-star red-star"></i>
                            <i class="pe-7s-star"></i>
                            <i class="pe-7s-star"></i>
                            <i class="pe-7s-star"></i>
                        </div>
                        <div class="quick-view-number">
                            <span>2 Ratting (S)</span>
                        </div>
                    </div>


                    {{-- Mrp - Price - Dsicount --}}
                    <div class="details-price">
                        <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>&#8377;</font> {{ moneyFormatIndia($product->product_mrp) }}</s></span>
                        <br>
                        <span><font class="rupees">&#8377;</font> {{ moneyFormatIndia($product->product_price) }} 
                            <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ $discount }}% off</b>
                        </span>
                    </div>

                    <div class="est-delivery-date">
                        <span>Est. Delivery Date: <b>{{ $est_dt->format( 'dS M, Y (D)' ) }}</b></span>
                    </div>
                    

                    {{-- Top product description --}}
                    <section class="top-description">
                        <p class="top-description">{!! $product->product_description !!}</p>
                    </section>

                    {{-- Quick actions --}}
                                                
                    <div class="quickview-plus-minus">

                        <div class="quickview-btn-cart" style="margin-left: 0;">
                            <a class="btn-hover-black" id="ToggleCartBtn" href="#">@if($carted == 1) Remove from cart @else Add to cart @endif</a>
                        </div>

                        <div class="quickview-btn-wishlist">
                            <a id="ToggleWishlistBtn" class="btn-hover @if($wishlisted == 1) btn-wishlisted @else btn-not-wishlisted @endif " href="#">&nbsp;<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;</a>
                        </div>
                    </div>

                    {{--  Category --}}
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Category :</li>
                            <li><a href="#">{{$category->category}}</a></li>
                        </ul>
                    </div>
                    
                    <div class="product-details-cati-tag mtb-10">
                        <ul>
                            <li class="categories-title">Tags :</li>
                            <li><a href="#">fashion</a></li>
                            <li><a href="#">electronics</a></li>
                            <li><a href="#">toys</a></li>
                            <li><a href="#">food</a></li>
                            <li><a href="#">jewellery</a></li>
                        </ul>
                    </div>


                </div>
            </div> {{-- Product details end --}}  
        </div>
    </div>
</div> {{-- area container end --}}









{{-- Description & Specification Area  --}}
<div class="product-description-review-area pb-90">
    <div class="container">
        <div class="product-description-review text-center">

             {{-- Description & Specifications Toggle Buttons --}}
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">Description</a>
                <a href="#pro-specifications" data-toggle="tab" role="tab" aria-selected="false">Specifications</a>
            </div>


            <div class="description-review-text tab-content">
                {{-- Description --}}
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p>{!! $product->product_description !!}</p>
                </div>

                {{-- Specifications --}}
                <div class="tab-pane fade" id="pro-specifications" role="tabpanel">
                    
                    <div class="row">
                        <div class="col-6">
                            <table class="specification-table">
                                @foreach ($specifications as $specification)
                                <tr>
                                    <th class="table-secondary">{{$specification->specification_key}}</th>
                                    <td>{{$specification->specification_value}}</td>
                                </tr>
                                @endforeach

                            </table>
                        </div>

                        <div class="col-6">
                            
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div> {{-- Description & Specification Area container end --}}











<!-- Related products area start -->
<div class="product-area pb-95">
    <div class="container">
        <div class="section-title-3 text-center mb-50">
            <h2>Related products</h2>
        </div>
        <div class="product-style">
            <div class="related-product-active owl-carousel">
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/1.jpg" alt="">
                        </a>
                        <span>hot</span>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/2.jpg" alt="">
                        </a>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/3.jpg" alt="">
                        </a>
                        <span>hot</span>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/4.jpg" alt="">
                        </a>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/5.jpg" alt="">
                        </a>
                        <span>hot</span>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/1.jpg" alt="">
                        </a>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="ezone/img/product/fashion-colorful/2.jpg" alt="">
                        </a>
                        <span>hot</span>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="#">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="#">Arifo Stylas Dress</a></h4>
                        <span>$115.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Related products area end -->



{{-- Data for ajax requests --}}
<div class="d-none">
    <form>
        <input name="product_id" value="{{ $product->id }}">
    </form> 
</div>

@endsection



@section('bottom-js')
    {{-- Toggle Cart --}}
    <script>
        $(document).ready(function() {

            $('#ToggleCartBtn').click(function (e) {

                e.preventDefault()

                var product_id  = $('input[name="product_id"]').val()

                console.log(product_id)

                $.ajax({
                    url: "{{route('toggle-cart-btn')}}",
                    method: 'POST',
                    data: {
                        'product_id' : product_id,
                    },
                    success: function (data) {

                        if (data == 200) {
                            console.log('Added to cart')
                            $('#ToggleCartBtn').html('remove from cart')
                            $('#CartCount').load("{{ route('cart') }} #CartCount")
                        } else if(data == 500) {
                            $('#ToggleCartBtn').html('add to cart')
                            $('#CartCount').load("{{ route('cart') }} #CartCount")
                        }
                    }
                })
            })
        })
    </script>


    {{-- Toggle Wishlist --}}
    <script>
        $(document).ready(function() {

            $('#ToggleWishlistBtn').click(function (e) {

                e.preventDefault()

                var product_id  = $('input[name="product_id"]').val()

                console.log(product_id)

                $.ajax({
                    url: "{{route('toggle-wishlist-btn')}}",
                    method: 'POST',
                    data: {
                        'product_id' : product_id,
                    },
                    success: function (data) {

                        if (data == 200) {
                            $('#ToggleWishlistBtn').addClass('btn-wishlisted').removeClass('btn-not-wishlisted')
                        } else if(data == 500) {
                            $('#ToggleWishlistBtn').addClass('btn-not-wishlisted').removeClass('btn-wishlisted')
                        }
                    }
                })
            })
        })
    </script>

    	<!-- Image Change On Hover -->
	<script>
		$(document).ready(function(){
			$('.small_img').hover(function(){
				$('.big_img').attr('src', $(this).attr('src'))
			})
		})
	</script>

	<!-- Initilize ImageZoomSL -->
	<script>
		$(document).ready(function(){
			$('.big_img').imagezoomsl({
				zoomrange: [3, 3]
			})
		})
	</script>
@endsection