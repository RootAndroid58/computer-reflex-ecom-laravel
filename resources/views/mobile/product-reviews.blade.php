@extends('layouts.mobile-common')

@section('title', 'Product Reviews')


@section('content')

<div class="body-container">
    <div class="container-fluid mt-3 account-details-container" style="max-width: 1300px;">
        <div class="row">

            <div class="col-md-12" style="border: 1px solid #f0f0f0; border-top: 0; border-bottom: 0;">
                <div class="row">
                    <div class="w-100" style="padding: 0px 5px 24px 32px; border: 1px solid #f0f0f0; border-left: 0; border-right: 0; border-top: 0;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <span style="color: black; font-size: 18px; font-weight: 500;">{{ $product->product_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div id="RatingAreaDIV">
                <div class="row">
                    <div class="w-100" style="border: 1px solid #f0f0f0; border-left: 0; border-right: 0; border-top: 0;">
                        
                        <div class="col-12 mb-3">
                            <div class="w-100 text-center">
                                <span style="font-size: 30px; color: rgb(27, 27, 27);">
                                    {{$stars}} <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <br>
                                <span>
                                    {{$reviews->count()}} Rating/Review @if($reviews->count() > 1)(S)@endif 
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="rating-slider-container row">
                                <div class="col-12">

                                    <div class="row " >
                                        <div class="col-2">
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
                                        <div class="col-2">
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

                                    <div class="row ">
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

                                    <div class="row ">
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

                                    <div class="row ">
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

                    </div>
                </div>

              
                    <div class="container mt-3">
                        <button class="btn btn-dark btn-block ReviewModalToggleBtn">@if ($reviewed == 1) Edit Review @else Rate Product @endif</button>
                    </div>
              

                <div class="row">
                    <div class="w-100">
                        <form id="ProductReviewForm" method="POST" class="d-none"> 
                            @csrf
                            <input type="hidden" name="action" value="{{route('review-submit')}}">
                              
                            <div style="padding: 24px 32px;">
                                <div class="mb-3">
                                    <span style="font-size: 18px; font-weight: 500;">Rate This Product <font style="color: red;">*</font></span>
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

                            <div style="padding: 24px 32px;">
                                <span style="font-size: 18px; font-weight: 500;">Review This Product</span> 
                                <div class="form-group mt-3">
                                <input type="text" value="{{ $ReviewCheck->title  ?? '' }}"
                                    class="form-control" maxlength="50" name="title" id="title" aria-describedby="helpId" placeholder="Title (Optional)">
                                </div>
                    
                                <div class="form-group">
                                <textarea maxlength="300" class="form-control" name="message" id="" rows="4" placeholder="Detailed Review...">{{ $ReviewCheck->message ?? '' }}</textarea>
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
                



                <div class="row mt-3">
                
                        <div class="col-9" >    
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="searchPre">
                                          <i class="fa fa-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="review_search" class="form-control" placeholder="Search for reviews..." aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                        </div>
                        <div class="col-3 pl-0">
                         
                                <div class="form-group">
                                    <select onchange="fetchReviews('new')" class="form-control" name="" id="sort_by" style="font-size: 14px;">
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

                
                            <div class="w-100 loadMoreBtnContainer text-center d-none">
                                <div class="mt-3" style="text-align: center;">
                                  <a class="cursor-pointer" style="color: #0066c0;"  id="loadMoreReviews">Load More...</a>
                                </div>
                            </div>
                     
                    </div>
                </div>
                </div>
                
                
          

            </div>
        </div>
    </div>
    
    
</div>
    

<input type="hidden" id="fetchType" value="new">
@endsection
    


@section('bottom-js')
<script>    
$('document').ready( function (){
    fetchReviews('new')
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
    fetchReviews('new')
}


</script>

@endsection