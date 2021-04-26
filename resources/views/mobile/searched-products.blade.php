@extends('layouts.mobile-common')


@section('title', 'Search: '.Request()->search)

@section('content')


<div class="container-fluid">

    
<div id="RowDiv">
    <div id="grid-sidebar3" class="tab-pane fade active show">
        
            <p style="font-size: 16px; margin-top: 15px;"><span style="font-weight: 600;">{{$ProductsCount}}</span> Products Found.</p>
       
    
        <div class="row">
            {{-- Product Col Start --}}
            @foreach ($products as $product)
            <div class="col-md-4 col-xl-3 col-6" style="border: 1px solid #f0f0f0">             
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

        <div class="mt-3 mb-3">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>

    </div>
</div>

</div>



@endsection