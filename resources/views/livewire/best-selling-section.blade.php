<div class="col-lg-6 col-xl-4">
    <div class="product-wrapper product-wrapper-border mb-30">
        <div class="product-img-5">
            <a href="{{route('product-index', $product->id)}}">
                <img loading="lazy" style="width: 100%; max-height: 100%;" src="{{ asset('storage/images/products/'.$product->images[0]->image) }}">
            </a>
        </div>
        <div class="product-content-7">
            <h4><a href="{{route('product-index', $product->id)}}" class="line-limit-2">{{$product->product_name}}</a></h4>
            <div class="product-rating-4">
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
                <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
            </div>
            <h5><font class="rupees">₹</font>{{moneyFormatIndia($product->product_price)}}</h5>
            <div class="product-action-electro">
                <a class="animate-top cursor-pointer @if (isset($product->carted)) bg-secondary bg-gradient text-white @endif " title="Add To Cart" wire:click="$emit('ToggleCart', {{$product->id}})">
                    <i class="pe-7s-cart"></i>
                </a>    
                <a class="animate-left cursor-pointer @if (isset($product->wishlisted)) bg-secondary bg-gradient text-white @endif" title="Wishlist" wire:click="$emit('ToggleWishlist', {{ $product->id }})">
                    <i class="pe-7s-like"></i>
                </a>
                <a class="animate-right cursor-pointer @if (isset($product->compared)) bg-secondary bg-gradient text-white @endif" title="Compare" wire:click="$emit('ToggleCompare', {{ $product->id }})">
                    <i class="pe-7s-repeat"></i>
                </a>
            </div>
        </div>
    </div>
</div>
