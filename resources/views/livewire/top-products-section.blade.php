<div class="custom-col-style-2 custom-col-4">
    <div class="product-wrapper product-border mb-24">
        <div class="product-img-3">
            <a href="{{ route('product-index', $product->id) }}" >
                <div class="prod-back-div" style="width: 100%; height: 175px; background-image: url('{{asset('storage/images/products/'.$product->images[0]->image)}}');"></div>
            </a>
            <div class="product-action-right">
                <a class="animate-right cursor-pointer compare-btn-b compare-btn-b{{ $product->id }} @if(isset($product->compared)) compare-btn-active @endif " title="Quick View" wire:click="$emit('ToggleCompare', {{ $product->id }})">
                    <i class="pe-7s-repeat"></i>
                </a>
                <a class="animate-top cursor-pointer cart-btn-b cart-btn-b{{ $product->id }} @if(isset($product->carted)) cart-btn-active @endif" title="Add To Cart" wire:click="$emit('ToggleCart', {{ $product->id }})">
                    <i class="pe-7s-cart"></i>
                </a>
                <a class="animate-left cursor-pointer wishlist-btn-b wishlist-btn-b{{ $product->id }} @if(isset($product->wishlisted)) wishlist-btn-active @endif" title="Wishlist" wire:click="$emit('ToggleWishlist', {{ $product->id }})">
                    <i class="pe-7s-like"></i>
                </a>
            </div>
        </div>
        <div class="product-content-4 text-center">
            <div class="product-rating-4">
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
            </div>
            <h4><a href="{{ route('product-index', $product->id) }}" class="line-limit-2">{{$product->product_name}}</a></h4>
            <span>
                <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>₹</s></font><s> 35,799</s></span> <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100) }}% off</b>
            </span>
            <h5><font class="rupees">₹</font>{{ moneyFormatIndia($product->product_price) }}</h5>
        </div>
    </div>
</div>
