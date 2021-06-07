<div class="product-wrapper">
    <div class="product-img">
        <a href="{{route('product-index', $product->id)}}">
            <div class="sm-prod-img-container" style="background-image: url('{{ asset('storage/images/products/'.$product->images[0]->image) }}');"></div>
        </a>
        <div class="product-action">
            <a class="animate-left @if (isset($product->wishlisted)) bg-info @endif " title="Wishlist" wire:click="$emit('ToggleWishlist', {{$product->id}})" style="cursor: pointer;">
                <i class="pe-7s-like"></i>
            </a>
            <a class="animate-right @if (isset($product->carted)) bg-info @endif " title="Add To Cart" wire:click="$emit('ToggleCart', {{$product->id}})" style="cursor: pointer;">
                <i class="pe-7s-cart"></i>
            </a>
            <a class="animate-right @if (isset($product->compared)) bg-info @endif " title="Compare" wire:click="$emit('ToggleCompare', {{$product->id}})" style="cursor: pointer;">
                <i class="pe-7s-repeat"></i>
            </a>
        </div>
    </div>
    <div class="product-content">
        <h4><a href="{{route('product-index', $product->id)}}" target="_blank" class="line-limit-2" title="{{$product->product_name}}"> {{$product->product_name}} </a></h4>
        <span><font class="rupees">₹</font> 
            {{ moneyFormatIndia($product->product_price) }}
            <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100) }}% off</b>
        </span>
    </div>
</div>