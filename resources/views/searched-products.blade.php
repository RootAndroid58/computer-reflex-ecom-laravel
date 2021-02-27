@extends('layouts.common')

@section('title', 'Products Search')
    
@section('modals')
            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="pe-7s-close" aria-hidden="true"></span>
                </button>
                <div class="modal-dialog modal-quickview-width" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="qwick-view-left">
                                <div class="quick-view-learg-img">
                                    <div class="quick-view-tab-content tab-content">
                                        <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                            <img src="assets/img/quick-view/l1.jpg" alt="">
                                        </div>
                                        <div class="tab-pane fade" id="modal2" role="tabpanel">
                                            <img src="assets/img/quick-view/l2.jpg" alt="">
                                        </div>
                                        <div class="tab-pane fade" id="modal3" role="tabpanel">
                                            <img src="assets/img/quick-view/l3.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="quick-view-list nav" role="tablist">
                                    <a class="active" href="#modal1" data-toggle="tab" role="tab">
                                        <img src="assets/img/quick-view/s1.jpg" alt="">
                                    </a>
                                    <a href="#modal2" data-toggle="tab" role="tab">
                                        <img src="assets/img/quick-view/s2.jpg" alt="">
                                    </a>
                                    <a href="#modal3" data-toggle="tab" role="tab">
                                        <img src="assets/img/quick-view/s3.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="qwick-view-right">
                                <div class="qwick-view-content">
                                    <h3>Handcrafted Supper Mug</h3>
                                    <div class="price">
                                        <span class="new">$90.00</span>
                                        <span class="old">$120.00  </span>
                                    </div>
                                    <div class="rating-number">
                                        <div class="quick-view-rating">
                                            <i class="pe-7s-star"></i>
                                            <i class="pe-7s-star"></i>
                                            <i class="pe-7s-star"></i>
                                            <i class="pe-7s-star"></i>
                                            <i class="pe-7s-star"></i>
                                        </div>
                                        <div class="quick-view-number">
                                            <span>2 Ratting (S)</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do tempor incididun ut labore et dolore magna aliqua. Ut enim ad mi , quis nostrud veniam exercitation .</p>
                                    <div class="quick-view-select">
                                        <div class="select-option-part">
                                            <label>Size*</label>
                                            <select class="select">
                                                <option value="">- Please Select -</option>
                                                <option value="">900</option>
                                                <option value="">700</option>
                                            </select>
                                        </div>
                                        <div class="select-option-part">
                                            <label>Color*</label>
                                            <select class="select">
                                                <option value="">- Please Select -</option>
                                                <option value="">orange</option>
                                                <option value="">pink</option>
                                                <option value="">yellow</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="quickview-plus-minus">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                        </div>
                                        <div class="quickview-btn-cart">
                                            <a class="btn-hover-black" href="#">add to cart</a>
                                        </div>
                                        <div class="quickview-btn-wishlist">
                                            <a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
@endsection


@section('content')


<div class="shop-page-wrapper shop-page-padding ptb-50">
    <div class="container-fluid">
        <div id="RowDiv">
        <div class="row">

            {{-- Sidebar Start --}}
            <div class="col-lg-2">
                <div class="shop-sidebar mr-50">
                 <form method="GET" action="{{ route('search') }}" id="filter_form">
                   
                    <input type="hidden" name="search" value="{{ request()->search }}">
                    <div class="sidebar-widget mb-45">
                        <h3 class="sidebar-title">Filter By Category</h3>
                        <div class="sidebar-categories">
                           <div class="form-group">
                             <select class="" name="category" id="" style="height: 30px; cursor: pointer;" >
                               <option value="all">All</option>
                               @foreach ($categories as $category)
                               <option value="{{$category->category}}" @if($category->category == request()->category) selected @endif>{{$category->category}}</option>
                               @endforeach
                             </select>
                           </div>
                        </div>
                    </div>
            
                    <div class="sidebar-widget mb-40">
                        <h3 class="sidebar-title">Filter by Price</h3>
                        <div class="price_filter">
                            <div class="price_slider_amount">
                                <div class="_2b0bUo">
                                    <div class="_1YAKP4">
                                        <input type="number" name="min_price" class="_2YxCDZ" value="{{ request()->min_price ?? '0' }}">
                                        <small id="helpId" class="form-text text-muted">Min Price</small>
                                    </div>

                                        <div class="_3zohzR">To</div>
                                    
                                        <div class="_3uDYxP">
                                            <input type="number" name="max_price" class="_2YxCDZ" value="{{ request()->max_price ?? '' }}">
                                            <small id="helpId" class="form-text text-muted">Max Price</small>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget mb-40">
                        <h3 class="sidebar-title">Availability</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="stock" value="checked" id="flexCheckDefault" @if(request()->stock == 'checked') checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Show Out Of Stock Items
                                </label>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Apply Filter</button>
                    </form>
                </div>
            </div>
            {{-- Sidebar End --}}






            <div class="col-lg-10">
                <div class="shop-product-wrapper res-xl">
                    <div class="shop-bar-area">



                        <div class="shop-bar pb-60">
                            <div class="shop-found-selector">
                                <div class="shop-found">
                                    <p><span>{{$products->count()}}</span> Products Found</p>
                                </div>
                                <div class="shop-selector">
                                    <label>Sort By : </label>
                                    <select name="select">
                                        <option value="">Default</option>
                                        <option value="">A to Z</option>
                                        <option value=""> Z to A</option>
                                        <option value="">In stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="shop-filter-tab">
                                <div class="shop-tab nav" role=tablist>
                                    <a class="active" href="#grid-sidebar3" data-toggle="tab" role="tab" aria-selected="false">
                                        <i class="ti-layout-grid4-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>



                        <div class="shop-product-content tab-content">
                            <div id="grid-sidebar3" class="tab-pane fade active show">
                                <div class="row">

                                    {{-- Product Col Start --}}
                                    @foreach ($products as $product)
                                 
                                    <div class="col-md-4 col-xl-3">             
                                        <div class="product-wrapper mb-30">
                                            <div class="product-img">
                                                <a href="{{route('product-index', $product->id)}}" target="_blank">
                                                    <img src="{{ asset('storage/images/products/'.$product->images[0]->image)}}" alt="">
                                                </a>
                                                <div class="product-action">
                                                    <a class="animate-left" title="Wishlist" href="#">
                                                        <i class="pe-7s-like"></i>
                                                    </a>
                                                    <a class="animate-top" title="Add To Cart" href="#">
                                                        <i class="pe-7s-cart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="#"> {{$product->product_name}} </a></h4>
                                                <span><font class="rupees">₹</font> 
                                                    {{ moneyFormatIndia($product->product_price) }}
                                                    <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100}}% off</b>
                                                </span>

                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- Product Col End --}}


                                 
        
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="pagination-style mt-50 text-center">
                    <ul>
                        <li><a href="#"><i class="ti-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">19</a></li>
                        <li class="active"><a href="#"><i class="ti-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>




@endsection


@section('bottom-js')



@endsection