@extends('layouts.common')

@section('title', 'Reviews')

@section('content')

<div class="body-container">
    <div class="container-fluid mt-3 account-details-container" style="max-width: 1300px;">
        <div class="row">
            <div class="col-3">
                <div class="row">
                    <div class="w-100" style="padding: 24px 20px 24px 20px">
                        <div class="w-100 prod-back-div" style="height: 246px; background-image: url('{{asset('storage/images/products/'.$product->images[0]->image)}}');"></div>
                    </div>
                    <div class="w-100" style="padding: 0px 20px 24px 20px">
                        <a href="{{ route('product-index', $product->id) }}" target="_blank">
                            <div class="w-100">
                                <span style="color: #0066c0; font-size: 18px;">{{ $product->product_name }}</span>
                            </div>
                        </a>
                       
                        <div class="mt-2">
                            <button type="button" class="btn btn-success btn-sm" style="height: unset;">
                                {{ $stars }} <span><i class="fa fa-star" aria-hidden="true"></i></span>
                            </button>
                            <span style="margin-left: 6px;">{{ $reviews->count() }} Review/Rating (S)</span>
                        </div>

                        <div class="mt-2">
                            <span style="font-size: 16px; font-weight: 500; color: #212121;"><font class="rupees">₹</font>{{ moneyFormatIndia($product->product_price) }}</span>
                            <span style="text-decoration: line-through; font-size: 14px;"><font class="rupees">₹</font>{{ moneyFormatIndia($product->product_mrp) }}</span>
                        </div>
                        
                    </div>
                </div>
               
            </div>

            <div class="col-9" style="border: 1px solid #f0f0f0; border-top: 0; border-bottom: 0;">
                <div class="row">
                    <div class="w-100" style="padding: 24px 5px 24px 32px; border: 1px solid #f0f0f0; border-left: 0; border-right: 0; border-top: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <span style="color: black; font-size: 18px; font-weight: 500;">{{ $product->product_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div id="RatingAreaDIV">
                <div class="row">
                    <div class="w-100" style="padding: 24px 5px 24px 32px; border: 1px solid #f0f0f0; border-left: 0; border-right: 0; border-top: 0;">
                        
                        <div class="col-3">
                            <span style="font-size: 30px; color: rgb(27, 27, 27);">
                                {{$stars}} <i class="fa fa-star" aria-hidden="true"></i>
                            </span>
                            <br>
                            <span>
                                {{$reviews->count()}} Rating/Review @if($reviews->count() > 1)(S)@endif 
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="rating-slider-container row">
                                <div class="col-12">

                                    <div class="row " >
                                        <div class="col-2" style="text-align:justify;">
                                            5 <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
    
                                        <div class="col-8">
                                            <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPerc['fivePerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            {{ moneyFormatIndia($ratingCounts['five']) }}
                                        </div>
                                    </div>

                                    <div class="row " >
                                        <div class="col-2" style="text-align:justify;">
                                            4 <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
    
                                        <div class="col-8">
                                            <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPerc['fourPerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            {{ moneyFormatIndia($ratingCounts['four']) }}
                                        </div>
                                    </div>

                                    <div class="row " style="text-align:justify;">
                                        <div class="col-2">
                                            3 <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
    
                                        <div class="col-8">
                                            <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$ratingPerc['threePerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            {{ moneyFormatIndia($ratingCounts['three']) }}
                                        </div>
                                    </div>

                                    <div class="row " style="text-align:justify;">
                                        <div class="col-2">
                                            2 <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
    
                                        <div class="col-8">
                                            <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ratingPerc['twoPerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            {{ moneyFormatIndia($ratingCounts['two']) }}
                                        </div>
                                    </div>

                                    <div class="row " style="text-align:justify;">
                                        <div class="col-2">
                                            <span>
                                                1 <i class="fa fa-star" aria-hidden="true"></i>
                                            </span>
                                            
                                        </div>
    
                                        <div class="col-8">
                                            <div style="margin: auto; display: block; vertical-align: middle; padding-top: 6px;">
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$ratingPerc['onePerc']}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            {{ moneyFormatIndia($ratingCounts['one']) }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                      

                        <div class="col-3">
                            <button class="btn btn-dark ReviewModalToggleBtn">@if ($reviewed == 1) Edit Review @else Rate Product @endif</button>
                        </div>

                    </div>
                </div>



                <div class="row">
                    <div class="w-100">
                        <form id="ProductReviewForm" method="POST" class="d-none"> 
                            @csrf
                            <input type="hidden" name="action" value="{{route('review-submit')}}">
                              
                            <div style="padding: 24px 32px;">
                                <div class="mb-3">
                                    <span style="font-size: 18px; font-weight: 500;">Rate This Product</span>
                                </div>
                                <input type="hidden" value="{{$product->id}}" name="product_id">
                            
                                <div class="form-field w-100">
                                    <select id="glsr-ltr" class="star-rating" name="rating" required>
                                        <option value="" disabled selected>Select a rating</option>
                                        <option value="5" @if($ReviewCheck->stars == 5) selected @endif>Fantastic</option>
                                        <option value="4" @if($ReviewCheck->stars == 4) selected @endif>Great</option>
                                        <option value="3" @if($ReviewCheck->stars == 3) selected @endif>Good</option>
                                        <option value="2" @if($ReviewCheck->stars == 2) selected @endif>Poor</option>
                                        <option value="1" @if($ReviewCheck->stars == 1) selected @endif>Terrible</option>
                                    </select>
                                </div>
                            </div>

                            <div style="border-top: 1px solid #dee2e6;"></div>

                            <div style="padding: 24px 32px;">
                                <span style="font-size: 18px; font-weight: 500;">Review This Product</span> 
                                <div class="form-group mt-3">
                                <input type="text" value="{{ $ReviewCheck->title }}"
                                    class="form-control" maxlength="50" name="title" id="title" aria-describedby="helpId" placeholder="Title (Optional)">
                                </div>
                    
                                <div class="form-group">
                                <textarea maxlength="300" class="form-control" name="message" id="" rows="4" placeholder="Detailed Review...">{{ $ReviewCheck->message }}</textarea>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary ReviewModalToggleBtn">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
             
                        </form>
                    </div>
                </div>
            </div>
                



                <div class="row">
                    <div class="w-100" style="padding: 24px 15px 0px 15px;">
                        <div class="col-9">
                           
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                    <input onkeyup="fetchReviews()" type="text" id="review_search" class="form-control" placeholder="Search for reviews..." aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                        </div>
                        <div class="col-3">
                         
                                <div class="form-group">
                                    <select onchange="fetchReviews()" class="form-control" name="" id="sort_by" style="font-size: 14px;">
                                    <option value="Not Selected" selected disabled>Sort By</option>
                                    <option value="Newest First">Newest First</option>
                                    <option value="Oldest First">Oldest First</option>
                                    <option value="Positive First">Positive First</option>
                                    <option value="Negative First">Negative First</option>
                                    <option value="Random">Random</option>
                                    </select>
                                </div>
                         
                        </div>
                    </div>
                </div>
                        
                {{-- Show Reviews Area --}}
                <div class="row">
                    <div class="w-100" style="padding: 10px 15px 32px 15px;">
                        <div class="row">

                       
                        @csrf
                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                        <input type="hidden" id="domain" value="{{ url('/') }}">
                        <input type="hidden" id="reviews_form_action" value="{{ route('get-product-reviews') }}">
                        <div id="ShowReviewsArea" class="mt-3 w-100">

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
                    </div>
                </div>
                </div>
                
                
          

            </div>
        </div>
    </div>

    
</div>
    
@endsection
    


@section('bottom-js')
<script>    
$('document').ready( function (){
    fetchReviews('new')
})

        
$(window).on('scroll', function() { 
    if ($(window).scrollTop() >= $( 
        '#ShowReviewsArea').offset().top + $('#ShowReviewsArea'). 
        outerHeight() - window.innerHeight) { 
        fetchReviews('more');
    } 
}); 

</script>

@endsection