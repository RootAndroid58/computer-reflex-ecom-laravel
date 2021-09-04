<div class="quickview-plus-minus">
    <div class="quickview-btn-cart" style="margin-left: 0; margin-right: 5px;">
        <a wire:click="$emit('ToggleCart', {{ $product->id }})" title="Cart" class="btn-hover-black cursor-pointer cart-btn-c cart-btn-c{{ $product->id }} @if(isset($product->carted)) cart-btn-active @endif">@if(isset($product->carted)) Remove from cart @else Add to cart @endif</a>
    </div>
    
    <div class="quickview-btn-wishlist">
        @if (Auth::check())
        <a wire:click="$emit('ToggleWishlist', {{ $product->id }})" title="Wishlist" class="btn-hover cursor-pointer wishlist-btn-c wishlist-btn-c{{$product->id}} @if(isset($product->wishlisted)) btn-wishlisted @else btn-not-wishlisted @endif ">&nbsp;<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;</a>
        @endif
        <a wire:click="$emit('ToggleCompare', {{ $product->id }})" title="Compare" style="vertical-align: unset" class="btn cursor-pointer compare-btn-c compare-btn-c{{$product->id}} @if(isset($product->compared)) btn-danger @else btn-info @endif ">&nbsp;<i class="fas fa-repeat"></i>&nbsp;</a>
    </div>
</div>
