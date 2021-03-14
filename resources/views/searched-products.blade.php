@extends('layouts.common')

@section('title', 'Products Search')
    


@section('content')


<div class="shop-page-wrapper shop-page-padding ptb-50">
    <div class="container-fluid">
        <div id="RowDiv">
        <div class="row">

            {{-- Sidebar Start --}}
            <div class="col-lg-2">
                <div class="shop-sidebar mr-50">
                 <form method="GET" action="{{ route('search') }}" id="filter_form" onsubmit="SubmitSearchFilterForm()">
                   
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
                                    <p><span>{{$ProductsCount}}</span> Products Found</p>
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
                                                    <div class="sm-prod-img-container" style="background-image: url('{{ asset('storage/images/products/'.$product->images[0]->image) }}');"></div>
                                                </a>
                                                <div class="product-action">
                                                    <a class="animate-left" onclick="ToggleWishlist({{$product->id}})" title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                                    <a class="animate-top" onclick="ToogleCart({{$product->id}})" title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="{{route('product-index', $product->id)}}"> {{$product->product_name}} </a></h4>
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
                                    {{-- Product Col End --}}
        
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                    <div>
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>

            </div>
        </div>
        </div>
    </div>
</div>




@endsection


@section('bottom-js')
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
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else if(data == 200) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Added to wishlist.", {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        }
    }
})

}

function ToogleCart(product_id) {

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
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else if(data == 500) {
            $('#CartCount').load("{{ route('cart') }} #CartCount")
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Removed From Cart.", {
                type: "danger",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        }
    }
})

}


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
</script>

@endsection