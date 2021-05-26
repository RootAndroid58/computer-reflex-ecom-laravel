@extends('layouts.mobile-common')

@section('title', $product->product_name)

@php
    $est_dt = new DateTime();
    $est_dt->modify( '+10 days' );
@endphp

@section('css-js')
    
@endsection



@section('content')
    <div class="container-fluid">
        
       

            <div style="width: 100%; height: 375px; text-align: center; line-height: 375px;" >
                <div class="zoom5">
                    <img id="big_img" src="{{ asset('img/grey.gif') }}" data-src="{{ asset('storage/images/products/'.$images[0]->image) }}" style="max-width: 100%;
                    max-height: 100%;
                    vertical-align: middle;
                    transition: 300ms;" alt="">
                </div>
            </div>
       
        
           
    </div>


       {{-- Categories Carousel Start --}}
        <div class="brand-logo-area-2 wrapper-padding mt-3 mb-3 no-before no-after">
            <div class="w-100">
                <div class="brand-logo-active2 owl-carousel">
                    @foreach ($images as $image)
                    <div class="single-brand" style="height: 100%; width: 65px; height: 65px;">
                        <div class="w-100" style="height: 100%; padding: 5px;">
                            <div class="prod-back-div images-menu" style="border: 1px solid grey; width: 100%; height: 100%; background-image: url('{{ asset('storage/images/products/'.$image->image) }}');"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Categories Carousel End --}}

 

        <div class="product-details-content container-fluid">

            <h3 style="font-size: 16px">{{$product->product_name}}</h3>
            <div class="rating-number">
                <div class="quick-view-rating">
                    
                    <i class="@if ($stars >= 1)fas fa-star green-star @else fas fa-star @endif" aria-hidden="true"></i>
                    <i class="@if ($stars >= 2)fas fa-star green-star @else fas fa-star @endif" aria-hidden="true"></i>
                    <i class="@if ($stars >= 3)fas fa-star green-star @else fas fa-star @endif" aria-hidden="true"></i>
                    <i class="@if ($stars >= 4)fas fa-star green-star @else fas fa-star @endif" aria-hidden="true"></i>
                    <i class="@if ($stars >= 5)fas fa-star green-star @else fas fa-star @endif" aria-hidden="true"></i>
                </div>
                <div class="quick-view-number">
                    <span>
                        {{$reviews->count()}} Rating/Review @if($reviews->count() > 1)(S)@endif 
                    </span>
                </div>
            </div>


            {{-- Mrp - Price - Dsicount --}}
            <div class="details-price" style="margin-bottom: 7px;">
                <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>&#8377;</font> {{ moneyFormatIndia($product->product_mrp) }}</s></span>
                <br>
                <span><font class="rupees">&#8377;</font> {{ moneyFormatIndia($product->product_price) }} 
                    <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ $discount }}% off</b>
                </span>
                @if ($product->product_stock <= 0)
                <br>
                <span class="text-danger">Out Of Stock</span>
                @endif
            </div>


            
            {{-- Quick actions --}}  

            @if ($product->product_stock > 0)
            <form action="{{ route('checkout-post') }}" method="post"> @csrf
                <input type="hidden" name="product_id[]" value="{{$product->id}}">
                <input type="hidden" name="product_qty[]" value="1">
                    <button class="btn btn-block btn-dark" style="padding: 10px 0.75rem;">
                        Buy Now
                    </button>
            </form>
            @endif
            

            
            
            <div class="quickview-plus-minus" style="margin-bottom: 15px;">
                <div class="quickview-btn-cart" style="margin-left: 0; margin-right: 5px;" >
                    <a style="font-weight: 400;" title="Cart" class="btn-hover-black btn-block" id="ToggleCartBtn" href="#">@if($carted == 1) Remove from cart @else Add to cart @endif</a>
                </div>
                
                <div class="quickview-btn-wishlist">
                    @if (Auth::check())
                    <a title="Wishlist" id="ToggleWishlistBtn" class="btn-hover cursor-pointer @if($wishlisted == 1) btn-wishlisted @else btn-not-wishlisted @endif ">&nbsp;<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;</a>
                    @endif
                    <a title="Compare" style="vertical-align: unset" id="ToggleCompareBtn" class="btn cursor-pointer @if($compared == 1) btn-secondary @else btn-light @endif ">&nbsp;<i class="fas fa-repeat"></i>&nbsp;</a>
                </div>
            </div>



            <div class="est-delivery-date">
                <span>Est. Delivery Date: <b>{{ $est_dt->format( 'dS M, Y (D)' ) }}</b></span>
            </div>
            

            {{-- Top product description --}}
            <section class="top-description w-100">
                <p class="top-description">{!! $product->product_description !!}</p>
            </section>

            @can('Admin') 
            <div class="row">
                <div class="col-12 mb-1">
                    <span style="font-weight: 600; font-size: 16px;">Admin Tools</span>
                </div>
                <div class="col-12 mb-3">
                    <a type="button" class="btn btn-info btn-sm" data-toggle="tooltip" href="{{ route('edit-product', $product->id) }}"
                        title="Edit Product">
                        Edit Product
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </a>
                </div>  
            </div>
            @endcan

            @if (isset($affiliateLink))
            @can('Affiliate') 
            <div class="row">
                <div class="col-12 mb-1">
                    <span style="font-weight: 600; font-size: 16px;">Affiliate Tools</span>
                    <p>
                        <span>Commision: 
                            @if (isset($product->comission->comission))
                                <span style="font-weight: 700;">{{ $product->comission->comission }}% </span>
                            @else
                                <span style="font-weight: 700;">Not Eligible</span>
                            @endif
                        </span>
                    </p>
                </div>
                <div class="col-12 mb-3">

                    <button type="button" class="btn btn-dark btn-copy js-tooltip js-copy" data-toggle="tooltip" 
                        data-placement="top" data-copy="{{ route('ShortUrlRedirect', $affiliateLink->short_url) }}" title="Copy to clipboard">
                        Link
                        <i class="fa fa-link" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-primary btn-copy js-tooltip js-copy" data-toggle="tooltip" 
                    data-placement="top" data-copy="{{ route('ShortUrlRedirect', $affiliateLink->short_url) }}" title="Copy to clipboard">
                    <i class="fab fa-facebook-square"></i>
                    </button>

                    <button type="button" class="btn btn-success btn-copy js-tooltip js-copy" data-toggle="tooltip" 
                    data-placement="top" data-copy="{{ route('ShortUrlRedirect', $affiliateLink->short_url) }}" title="Copy to clipboard">
                    <i class="fab fa-whatsapp-square"></i>
                    </button>

                    <button type="button" class="btn btn-primary btn-copy js-tooltip js-copy" data-toggle="tooltip" 
                    data-placement="top" data-copy="{{ route('ShortUrlRedirect', $affiliateLink->short_url) }}" title="Copy to clipboard">
                    <i class="fab fa-twitter-square"></i>   
                    </button>

                </div>  
            </div>
            @endcan
            @endif
            


            {{--  Category --}}
            <div class="product-details-cati-tag ">
                <ul>
                    <li class="categories-title">Category :</li>
                    <li><a href="#">{{$category->category}}</a></li>
                </ul>
            </div>
        
        </div>




        {{-- Description & Specification Area  --}}
            <div class="product-description-review-area mt-5">
                <div class="container-fluid" style="max-width: 1500px;">
                    <div class="product-description-review text-center">

                        {{-- Description & Specifications Toggle Buttons --}}
                        <div class="description-review-title nav mb-3 " role=tablist>
                            @if ($product->product_long_description != '')
                            <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">Description</a>
                            @endif
                            <a class="@if (!isset($product->product_long_description)) active @endif" href="#pro-specifications" data-toggle="tab" role="tab" aria-selected="false">Specifications</a>
                        </div>


                        <div class="description-review-text tab-content">
                            {{-- Description --}}
                            @if (isset($product->product_long_description))
                                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                                    <div class="long-description">
                                        <p>{!! $product->product_long_description !!}</p>
                                    </div>
                                    
                                </div>
                            @endif
                            
                            {{-- Specifications --}}
                            <div class="tab-pane @if (!isset($product->product_long_description)) show active @endif fade" id="pro-specifications" role="tabpanel">
                                
                           
                                    <div style="text-align: center">
                                        <table class="specification-table">
                                            @foreach ($specifications as $specification)
                                            <tr>
                                                <td style="width: 30%; background-color: #F3F3F3;">{{$specification->specification_key}}</td>
                                                <td style="width: 70%;">{{$specification->specification_value}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                               
                                

                            </div>
                        </div>


                    </div>
                </div>
            </div> 
        {{-- Description & Specification Area container end --}}


















        {{-- Description & Specification Area  --}}
<div class="product-description-review-area mt-5">
    <div class="container">
        <div class="product-description-review text-center">

             {{-- Description & Specifications Toggle Buttons --}}
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#rating_Rev" data-toggle="tab" role="tab" aria-selected="false">Ratings & Reviews
                <a href="#qna" data-toggle="tab" role="tab" aria-selected="true">Questions & Answers</a>
                </a>
            </div>


            <div class="description-review-text tab-content">

                {{-- Rating Reviews Section --}}
                
                <div class="tab-pane active show fade" id="rating_Rev" role="tabpanel">
                    <div id="RatingAreaDIV">

                    <div class="" style="border: 1px solid #dddddd; border-radius: 2px;"> 
                        <div class="row">
                            <div class="col-md-3 mt-3 mb-3" >
                                <span style="font-size: 30px; color: rgb(27, 27, 27);">
                                    {{$stars}} <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <br>
                                <span>
                                    {{$reviews->count()}} Rating/Review @if($reviews->count() > 1)(S)@endif 
                                </span>
                            </div>

                            <div class="col-md-6">



                                <div class="rating-slider-container row">
                                    <div class="col-md-12">

                                        <div class="row " >
                                            <div class="col-3">
                                                5 <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
        
                                            <div class="col-6" style="padding: 0;">
                                                <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPerc['fivePerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                {{ moneyFormatIndia($ratingCounts['five']) }}
                                            </div>
                                        </div>

                                        <div class="row " >
                                            <div class="col-3">
                                                4 <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
        
                                            <div class="col-6" style="padding: 0;">
                                                <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPerc['fourPerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                {{ moneyFormatIndia($ratingCounts['four']) }}
                                            </div>
                                        </div>

                                        <div class="row " >
                                            <div class="col-3">
                                                3 <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
        
                                            <div class="col-6" style="padding: 0;">
                                                <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPerc['threePerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                {{ moneyFormatIndia($ratingCounts['three']) }}
                                            </div>
                                        </div>

                                        <div class="row " >
                                            <div class="col-3">
                                                2 <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
        
                                            <div class="col-6" style="padding: 0;">
                                                <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ratingPerc['twoPerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                {{ moneyFormatIndia($ratingCounts['two']) }}
                                            </div>
                                        </div>

                                        <div class="row " >
                                            <div class="col-3">
                                                <span>
                                                    1 <i class="fa fa-star" aria-hidden="true"></i>
                                                </span>
                                                
                                            </div>
        
                                            <div class="col-6" style="padding: 0;">
                                                <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$ratingPerc['onePerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                {{ moneyFormatIndia($ratingCounts['one']) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>




                            </div>

                            @if ($ordered == 1)
                            <div class="col-md-3 mt-3">
                                <button class="btn btn-block btn-dark ReviewModalToggleBtn">@if ($reviewed == 1) Edit Review @else Rate Product @endif</button>
                            </div>
                            @endif
                            
                        </div>

                    </div>




                    <form id="ProductReviewForm" method="POST" class="d-none"> 
                        @csrf
                        <input type="hidden" name="action" value="{{route('review-submit')}}">
                    <div class="modal-content ">
                        <div class="modal-body" style="display: unset;">
                
                            <div class="mb-3">
                                <span style="font-size: 18px; font-weight: 500;">Rate This Product</span>
                            </div>
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                        
                                <div class="form-field w-100">
                                    <select id="glsr-ltr" class="star-rating" name="rating" required>
                                        <option value="" disabled selected>Select a rating</option>
                                        <option value="5" @if(isset($ReviewCheck->stars) && $ReviewCheck->stars == 5) selected @endif>Fantastic</option>
                                        <option value="4" @if(isset($ReviewCheck->stars) && $ReviewCheck->stars == 4) selected @endif>Great</option>
                                        <option value="3" @if(isset($ReviewCheck->stars) && $ReviewCheck->stars == 3) selected @endif>Good</option>
                                        <option value="2" @if(isset($ReviewCheck->stars) && $ReviewCheck->stars == 2) selected @endif>Poor</option>
                                        <option value="1" @if(isset($ReviewCheck->stars) && $ReviewCheck->stars == 1) selected @endif>Terrible</option>
                                    </select>
                                </div>
                        
                            
                        </div>
                        <div style="border-top: 1px solid #dee2e6;"></div>
                        <div class="modal-body" style="display: unset;">
                            <span style="font-size: 18px; font-weight: 500;">Review This Product</span> 
                            <div class="form-group mt-3">
                            <input type="text" value="{{ $ReviewCheck->title ?? '' }}"
                                class="form-control" maxlength="50" name="title" id="title" aria-describedby="helpId" placeholder="Title (Optional)">
                            </div>
                
                            <div class="form-group">
                            <textarea maxlength="300" class="form-control" name="message" id="" rows="4" placeholder="Detailed Review...">{{ $ReviewCheck->message ?? '' }}</textarea>
                            </div>
                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary ReviewModalToggleBtn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>

                    @foreach ($reviews as $review)
                       @if ($review->message != '' || $review->title != '')
                        <div class="wishlist-basic-padding" style="border: 1px solid #dddddd; border-radius: 2px; border-top: 0;">
                            <div class="row">
                                <button type="button" class="btn btn-dark btn-sm">
                                    {{-- 6969696 --}}
                                    {{$review->stars}} <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                </button>
                                <span style="padding-left: 12px; padding-top: 3px; font-size: 14px; color: #212121; font-weight: 500;">{{ $review->title ?? '' }}</span>
                            </div>
                            <div class="row">
                                <span style="margin: 12px 0;">
                                    {{ $review->message }}
                                </span>
                            </div>

                            <div class="row">
                                <span style="margin: 12px 0;">
                                    {{ $review->user->name }} <img width="14" src="{{ asset('img/grey.gif') }}" data-src="{{asset('img/svg/verified-tick.svg')}}" alt=""> (Buyer), {{ HowMuchOldDate($review->created_at, 'days') }} ago
                                </span>
                            </div>
                        </div>        
                           
                        @endif
                    @endforeach

                    @if ($reviews->count() >= 1)
                        <div class="view-more-continer mt-3" >
                            <a href="{{route('all-product-reviews', $product->id)}}">
                                <span style="color: #0066c0;" class="hover-blue"> All {{ App\Models\ProductReview::where('product_id', $product->id)->count() }} Reviews <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    @endif
                    

                </div>
            </div>



                    {{-- Qna Section --}}
                    <div class="tab-pane fade" id="qna" role="tabpanel">

                        <div class="" style="border-radius: 2px;">

                                <div style="border-bottom: 1px solid #dddddd;">
                                    <div class="row" >
                                        <div class="w-100" style="">
                                            <div class="col-9">
                                    
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text" id="searchPre">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" id="review_search" class="form-control" placeholder="Search for answers..." aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                            </div>
                                            <div class="col-3" style="padding-left: 0;">
                                    
                                                    <div class="form-group">
                                                        <select onchange="fetchQnas('new')" class="form-control" name="" id="sort_by" style="font-size: 14px;">
                                                        <option value="Not Selected" selected disabled>Sort By</option>
                                                        <option value="Random">Default</option>
                                                        <option value="Newest First">Newest First</option>
                                                        <option value="Oldest First">Oldest First</option>
                                                        </select>
                                                    </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>            
                                  
                                    <div class="">
                                        <div class="w-100" style="padding-bottom: 22px;" >
                                            @csrf
                                            <input type="hidden" id="product_id" value="{{ $product->id }}">
                                            <input type="hidden" id="domain" value="{{ url('/') }}">
                                            <input type="hidden" id="reviews_form_action" value="{{ route('get-product-qnas') }}">
                                            <div id="ShowReviewsArea" class="mt-3 w-100" style="padding-bottom: 30px;
                                            border-bottom: 1px solid #dddddd;">

                                                <div class="div-loader" id="reviewsDivLoader">
                                                    <div style="text-align: center;">
                                                        <div class="spinner-border text-dark" role="status" style="width: 90px; height: 90px; ">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                        <br>
                                                        <div class="mt-3">
                                                            <span>Loading...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                                <div class="w-100 loadMoreBtnContainer text-center d-none">
                                                    <div class="mt-3" style="text-align: center;">
                                                    <a class="cursor-pointer" style="color: #0066c0;"  id="loadMoreQnas">Load More...</a>
                                                    </div>
                                                </div>

                                                <div class="w-100 text-center mt-3 mb-3"    >
                                                    <div class="mb-3 mt-3">Don't see the answer you're looking for? </div>
                                                    <button class="btn btn-dark btn-sm" id="PostQuestionBtn">Post Question</button>
                                                </div>
                                        </div>
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
        <div class="section-title-3 text-center mb-2 mt-5">
            <h2>Related products</h2>
        </div>
        <div class="product-style">
            <div class="related-product-active owl-carousel">

                @if (isset($RelatedProducts))
                @foreach ($RelatedProducts as $RelatedProduct)
                @if ($RelatedProduct->id != $product->id)
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="{{route('product-index', $RelatedProduct->id)}}">
                            <div class="sm-prod-img-container" style="background-image: url('{{ asset('storage/images/products/'.$RelatedProduct->images[0]->image) }}');"></div>
                        </a>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" onclick="ToggleWishlist({{$RelatedProduct->id}})" style="cursor: pointer;">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-right" title="Add To Cart" onclick="ToggleCart({{$RelatedProduct->id}})" style="cursor: pointer;">
                                <i class="pe-7s-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="{{route('product-index', $RelatedProduct->id)}}" target="_blank" class="line-limit-2" title="{{$RelatedProduct->product_name}}"> {{$RelatedProduct->product_name}} </a></h4>
                        <span><font class="rupees">₹</font> 
                            {{ moneyFormatIndia($RelatedProduct->product_price) }}
                            <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ round((($RelatedProduct->product_mrp - $RelatedProduct->product_price) / $RelatedProduct->product_mrp)*100) }}% off</b>
                        </span>
                    </div>
                </div>
                @endif
                @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
<!-- Related products area end -->




@endsection




@section('bottom-js')
    
<script>
    new window.PinchZoom.default(document.querySelector('div.zoom5'), {});
</script>

<script>

   $('document').ready( function (){
       fetchQnas('new')
   })
   
   


   //setup before functions
   var typingTimer;                //timer identifier
   var doneTypingInterval = 1500;  //time in ms, 5 second for example
   var $input = $('#review_search');
   
   //on keyup, start the countdown
   $input.on('keyup', function () {
       $('#searchPre').html(`<i class="fa fa-spinner fa-spin"></i>`)
       clearTimeout(typingTimer);
       typingTimer = setTimeout(doneTyping, doneTypingInterval);
   });
   
   //on keydown, clear the countdown 
   $input.on('keydown', function () {
     clearTimeout(typingTimer);
   });
   
   //user is "finished typing," do something
   function doneTyping () {
       $('#searchPre').html(`<i class="fa fa-search" aria-hidden="true"></i>`)
       $('#searchPre').removeClass('searchLoading')
       fetchQnas('new')
   }
   
   
   
   
   // COPY TO CLIPBOARD
   // Attempts to use .execCommand('copy') on a created text field
   // Falls back to a selectable alert if not supported
   // Attempts to display status in Bootstrap tooltip
   // ------------------------------------------------------------------------------
   
   function copyToClipboard(text, el) {
     var copyTest = document.queryCommandSupported('copy');
     var elOriginalText = el.attr('data-original-title');
   
     if (copyTest === true) {
       var copyTextArea = document.createElement("textarea");
       copyTextArea.value = text;
       document.body.appendChild(copyTextArea);
       copyTextArea.select();
       try {
         var successful = document.execCommand('copy');
         var msg = successful ? 'Copied!' : 'Whoops, not copied!';
         el.attr('data-original-title', msg).tooltip('show');
       } catch (err) {
         console.log('Oops, unable to copy');
       }
       document.body.removeChild(copyTextArea);
       el.attr('data-original-title', elOriginalText);
     } else {
       // Fallback if browser doesn't support .execCommand('copy')
       window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
     }
   }
   
   $(document).ready(function() {
     // Initialize
     // ---------------------------------------------------------------------
   
     // Tooltips
     // Requires Bootstrap 3 for functionality
     $('.js-tooltip').tooltip();
   
     // Copy to clipboard
     // Grab any text in the attribute 'data-copy' and pass it to the 
     // copy function
     $('.js-copy').click(function() {
       var text = $(this).attr('data-copy');
       var el = $(this);
       copyToClipboard(text, el);
     });
   });
   </script>




<script>
   function ToggleCompare(product_id) {
   
   $.ajax({
       url: "{{route('toggle-compare-btn')}}",
       method: 'POST',
       data: {
           'product_id' : product_id,
       },
       success: function (data) {
           if (data.status == 500 || data.status == 200) {
               $(".bootstrap-growl").remove();
               $.bootstrapGrowl(data.msg, {
                   type: data.type,
                   offset: {from:"bottom", amount: 100},
                   align: 'center',
                   allow_dismis: true,
                   stack_spacing: 10,
               })
           }
       }
   })
   
   }
</script>
   

<script>

function ToggleWishlist(product_id) {
   
   $.ajax({
       url: "{{route('toggle-wishlist-btn')}}",
       method: 'POST',
       data: {
           'product_id' : product_id,
       },
       success: function (data) {
   
           if (data == 500) {
               $(".bootstrap-growl").remove();
               $.bootstrapGrowl("Removed from wishlist.", {
                   type: "danger",
                   offset: {from:"bottom", amount: 50},
                   align: 'center',
                   allow_dismis: true,
                   stack_spacing: 10,
               })
           } else if(data == 200) {
               $(".bootstrap-growl").remove();
               $.bootstrapGrowl("Added to wishlist.", {
                   type: "success",
                   offset: {from:"bottom", amount: 50},
                   align: 'center',
                   allow_dismis: true,
                   stack_spacing: 10,
               })
           }
       }
   })
   
   }
       
</script>

<script>
   function ToggleCart(product_id) {
   
       $.ajax({
       url: "{{route('toggle-cart-btn')}}",
       method: 'POST',
       data: {
           'product_id' : product_id,
       },
       success: function (data) {
   
           if (data == 200) {
               $('#CartCount').load("{{ route('cart') }} #CartCount")
               $(".bootstrap-growl").remove();
               $.bootstrapGrowl("Added To Cart.", {
                   type: "success",
                   offset: {from:"top", amount: 100},
                   align: 'center',
                   allow_dismis: true,
                   stack_spacing: 10,
               })
           } else if(data == 500) {
               $('#CartCount').load("{{ route('cart') }} #CartCount")
               $(".bootstrap-growl").remove();
               $.bootstrapGrowl("Removed From Cart.", {
                   type: "danger",
                   offset: {from:"top", amount: 100},
                   align: 'center',
                   allow_dismis: true,
                   stack_spacing: 10,
               })
           }
       }
   })
   
   }
   </script>



   <script>

           $('#ToggleCartBtn').click(function () {
           
               var product_id  = $('input[name="product_id"]').val();

               $.ajax({
                   url: "{{ route('toggle-cart-btn') }}",
                   method: 'POST',
                   data: {
                       'product_id' : product_id,
                   },
                   success: function (data) {
                       if (data == 200) {
                           $('#ToggleCartBtn').html('remove from cart');
                           $('#CartCount').load("{{ route('cart') }} #CartCount");
                       } else if(data == 500) {
                           $('#ToggleCartBtn').html('add to cart');
                           $('#CartCount').load("{{ route('cart') }} #CartCount");
                       }
                   }
               })
           })
           
        </script>

        <script>
            $('#ToggleCompareBtn').click(function (e) {

                e.preventDefault()

                var product_id  = $('input[name="product_id"]').val()

                console.log(product_id)

                $.ajax({
                    url: "{{route('toggle-compare-btn')}}",
                    method: 'POST',
                    data: {
                        'product_id' : product_id,
                    },
                    success: function (data) {
                        if (data.status == 500 || data.status == 200) {
                            $(".bootstrap-growl").remove();
                            $.bootstrapGrowl(data.msg, {
                                type: data.type,
                                offset: {from:"bottom", amount: 100},
                                align: 'center',
                                allow_dismis: true,
                                stack_spacing: 10,
                            })
                        }

                        if (data.status == 200) {
                            console.log(200);
                            $('#ToggleCompareBtn').addClass('btn-secondary').removeClass('btn-light')
                            // $('#CartCount').load("{{ route('cart') }} #CartCount")
                        } else if(data.status == 500) {
                            console.log(500);
                            $('#ToggleCompareBtn').addClass('btn-light').removeClass('btn-secondary')
                            // $('#CartCount').load("{{ route('cart') }} #CartCount")
                        }
                    }
                })
            });
    </script>



   <script>
       $(document).ready(function() {

           $('#ToggleWishlistBtn').click(function (e) {
               e.preventDefault()
               var product_id  = $('input[name="product_id"]').val()

               $.ajax({
                   url: "{{route('toggle-wishlist-btn')}}",
                   method: 'POST',
                   data: {
                       'product_id' : product_id,
                   },
                   success: function (data) {
                       
                       if (data == 200) {
                           $('#ToggleWishlistBtn').addClass('btn-wishlisted').removeClass('btn-not-wishlisted')
                           $(".bootstrap-growl").remove();
                           $.bootstrapGrowl('Added To Wishlist.', {
                               type: 'success',
                               offset: {from:"bottom", amount: 100},
                               align: 'center',
                               allow_dismis: true,
                               stack_spacing: 10,
                           });
                       } else if(data == 500) {
                           $(".bootstrap-growl").remove();
                           $.bootstrapGrowl('Removed From Wishlist.', {
                               type: 'danger',
                               offset: {from:"bottom", amount: 100},
                               align: 'center',
                               allow_dismis: true,
                               stack_spacing: 10,
                           });
                           $('#ToggleWishlistBtn').addClass('btn-not-wishlisted').removeClass('btn-wishlisted')
                       }
                   }
               })
           })
       });
   </script>


@endsection
    