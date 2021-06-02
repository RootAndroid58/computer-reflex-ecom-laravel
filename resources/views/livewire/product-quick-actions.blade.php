{{-- {{ dd($carted, $wishlisted, $compared) }} --}}
<div class="quickview-plus-minus">
    <div class="quickview-btn-cart" style="margin-left: 0; margin-right: 5px;">
        <a wire:click="ToggleCart({{ $product->id }})" title="Cart" class="btn-hover-black cursor-pointer">@if($carted == 1) Remove from cart @else Add to cart @endif</a>
    </div>
    
    <div class="quickview-btn-wishlist">
        @if (Auth::check())
        <a wire:click="ToggleWishlist({{ $product->id }})" title="Wishlist" class="btn-hover cursor-pointer @if($wishlisted == 1) btn-wishlisted @else btn-not-wishlisted @endif ">&nbsp;<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;</a>
        @endif
        <a wire:click="ToggleCompare({{ $product->id }})" title="Compare" style="vertical-align: unset" class="btn cursor-pointer @if($compared == 1) btn-danger @else btn-info @endif ">&nbsp;<i class="fas fa-repeat"></i>&nbsp;</a>
    </div>
</div>
