<div class="owl-item">
    <div class="product-wrapper mb-30">
        <div class="product-img">
            <a href="{{ route('product-index', $product->id) }}" target="_blank">
                <div class="sm-prod-img-container">
                    <img loading="lazy" class="d-block" style="margin:auto; width: auto; max-width: 100%; max-height: 100%;" src="{{ asset('storage/images/products/'.$product->images[0]->image) }}" alt="" srcset="">
                </div>
            </a>
            <div class="product-action">
                <a class="animate-left cursor-pointer  @if(isset($product->wishlisted)) text-white bg-info bg-gradient @endif " wire:click="$emit('ToggleWishlist', {{ $product->id }})" title="Wishlist"><i class="pe-7s-like"></i></a>
                <a class="animate-top cursor-pointer   @if(isset($product->carted)) text-white bg-info bg-gradient @endif" wire:click="$emit('ToggleCart', {{ $product->id }})" title="Add To Cart"><i class="pe-7s-cart"></i></a>
                <a class="animate-right cursor-pointer @if(isset($product->compared)) text-white bg-info bg-gradient @endif" wire:click="$emit('ToggleCompare', {{ $product->id }})" title="Compare"><i class="pe-7s-repeat"></i></a>
            </div>
        </div>
        <div class="product-rating-4" style="text-align: center">
            <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
            <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
            <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
            <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
            <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
        </div>
        <div class="product-content" style="text-align: center">
            <h4><a class="line-limit-2" href="{{route('product-index', $product->id)}}"> {{$product->product_name}} </a></h4>
            <span><font class="rupees">₹</font> 
                {{ moneyFormatIndia($product->product_price) }}
                <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)}}% off</b>
            </span>
            @if ($product->product_stock <= 0)
                <br>
                <span class="text-danger">Out Of Stock</span>
            @endif
        </div>
    </div>
</div> 