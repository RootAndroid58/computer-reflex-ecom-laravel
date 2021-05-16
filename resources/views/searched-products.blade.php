@if (isMobile())

    @include('mobile.searched-products')

{{ die }}
@endif



@extends('layouts.common')

@section('title', 'Search: '.Request()->search)
    


@section('content')


<div class="shop-page-wrapper shop-page-padding ptb-50">
    <div class="container-fluid">
        <div>
        <div class="row">
            {{-- Sidebar Start --}}
            <div class="col-lg-2">
                <div id="SideBar">
                    <div class="shop-sidebar">

                        
                    <form method="GET" action="@if(isset($slug)){{route('show-catalog', $slug)}}@else{{ route('search')}}@endif" id="filter_form">
                        <input type="hidden" name="sort_by" value="">
                        <input type="hidden" name="search" value="{{ request()->search }}">
                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title">Filter By Category</h3>
                            <div class="sidebar-categories">
                            <div class="form-group">
                                <select onchange="submitFilterForm()" class="" name="category" id="" style="height: 30px; cursor: pointer;" >
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
                                            <input  onkeyup="submitFilterForm()" type="number" name="min_price" class="_2YxCDZ" value="{{ request()->min_price ?? '' }}">
                                            <small id="helpId" class="form-text text-muted">Min Price</small>
                                        </div>

                                            <div class="_3zohzR">To</div>
                                        
                                            <div class="_3uDYxP">
                                                <input onkeyup="submitFilterForm()" type="number" name="max_price" class="_2YxCDZ" value="{{ request()->max_price ?? '' }}">
                                                <small id="helpId" class="form-text text-muted">Max Price</small>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget mb-40">
                            <h3 class="sidebar-title">Availability</h3>
                                <div class="form-check">
                                    <input onchange="submitFilterForm()" class="form-check-input" type="checkbox" name="stock" value="checked" id="flexCheckDefault" @if(request()->stock == 'checked') checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Show Out Of Stock Items
                                    </label>
                                </div>
                        </div>

                    
                        <div class="sidebar-widget mb-40">
                            <h3 class="sidebar-title">Specifications</h3>


                                <div class="collapse-item" style="border-bottom: 1px solid rgb(197, 197, 197);">
                                    <div class="collapse-btn" style="padding: 7px 10px; transition: all 200ms; background-color: rgba(212, 212, 212, 0.781);">
                                        <span style="font-weight: 600">Brand</span>
                                    </div>
                                    <div class="collapse-content">
                                    
                                        @foreach ($brands as $brand => $value)
                                            <div style="padding-top: 6px; padding-bottom: 6px;">
                                                <div class="form-check">
                                                    <input onchange="submitFilterForm()" class="form-check-input cursor-pointer" name="brands[]" value="{{ $brand }}" type="checkbox" id="{{ $brand }}">
                                                    <label class="form-check-label cursor-pointer line-limit-2" for="{{$brand}}">{{$brand}}</label>
                                                </div>
                                            </div>
                                            <div class="account-menu-break"></div>  
                                        @endforeach
                                    </div>
                                </div>                         
                               


                                @foreach ($SpecsFilter as $Group => $SpecsGroup)
                                <div class="collapse-item" style="border-bottom: 1px solid rgb(197, 197, 197);">
                                    @php
                                    if (isset(Request()->specs[$Group])) {
                                        $checked = Request()->specs[$Group];
                                    } else {
                                        $checked = null;
                                    }
                                    @endphp
                                    <div class="collapse-btn @if($checked != null) on @endif" style="padding: 7px 10px; transition: all 200ms; background-color: rgba(212, 212, 212, 0.781);">
                                        <span style="font-weight: 600">{{ $Group }}</span>
                                    </div>
                                    <div class="collapse-content" style="@if($checked != null) max-height: fit-content; transition: all 200ms; @endif ">
                                       
                                        @foreach ($SpecsGroup as $Specs)
                                            <div style="padding-top: 6px; padding-bottom: 6px;">
                                                <div class="form-check">
                                                    <input onchange="submitFilterForm()" class="form-check-input cursor-pointer" name="specs[{{$Group}}]" value="{{$Specs->specification_value}}" type="checkbox" id="{{$Specs->specification_value.$Specs->id}}" @if ($checked == $Specs->specification_value) checked @endif>
                                                    <label class="form-check-label cursor-pointer line-limit-2" for="{{$Specs->specification_value.$Specs->id}}">{{$Specs->specification_value}}</label>
                                                </div>
                                            </div>
                                            <div class="account-menu-break"></div>  
                                        @endforeach
                                    </div>
                                </div>
                                
                                @endforeach
                             
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Sidebar End --}}




            <div class="col-lg-10">
                <div id="RowDiv" class="w-100">
                    <div class="shop-product-wrapper res-xl">
                        <div class="shop-bar-area">


                            <div class="shop-bar pb-60">
                                <div class="shop-found-selector">
                                    <div class="shop-found">
                                        <p><span>{{$ProductsCount}}</span> Products Found</p>
                                    </div>
                                    <div class="shop-selector">
                                        <label>Sort By : </label>
                                        <select id="sort_by_select">
                                            <option value="Default">Default</option>
                                            <option @if (Request()->sort_by == 'A to Z') selected @endif value="A to Z">A to Z</option>
                                            <option @if (Request()->sort_by == 'Z to A') selected @endif value="Z to A">Z to A</option>
                                            <option @if (Request()->sort_by == 'Price Low to High') selected @endif value="Price Low to High">Price Low to High</option>
                                            <option @if (Request()->sort_by == 'Price High to Low') selected @endif value="Price High to Low">Price High to Low</option>
                                            {{-- <option @if (Request()->sort_by == 'Highest Rating First') selected @endif value="Highest Rating First">Highest Rating First</option>
                                            <option @if (Request()->sort_by == 'Lowest Rating First') selected @endif value="Lowest Rating First">Lowest Rating First</option> --}}
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
                                                        <div class="sm-prod-img-container prod-back-div" style="background-image: url('{{ asset('storage/images/products/'.$product->images[0]->image) }}');"></div>
                                                    </a>
                                                    <div class="product-action">
                                                        <a class="animate-left cursor-pointer" onclick="ToggleWishlist({{$product->id}})" title="Wishlist"><i class="pe-7s-like"></i></a>
                                                        <a class="animate-top cursor-pointer" onclick="ToogleCart({{$product->id}})" title="Add To Cart"><i class="pe-7s-cart"></i></a>
                                                        <a class="animate-right cursor-pointer" onclick="ToggleCompare({{$product->id}})" title="Compare"><i class="pe-7s-repeat"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h4><a class="line-limit-3" href="{{route('product-index', $product->id)}}"> {{$product->product_name}} </a></h4>
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
</div>




@endsection


@section('bottom-js')
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


<script>
    


</script>

<script>
    function submitFilterForm() {
        $('#filter_form').submit();
    }
</script>

@endsection