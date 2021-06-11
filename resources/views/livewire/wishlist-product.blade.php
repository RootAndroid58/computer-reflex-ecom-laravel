<div class="row wishlist-basic-padding" id="WishItem{{ $product->id }}">
    <div class="col-md-3">
        <a href="{{ url('product/'.$product->id) }}" target="_blank">
            <div class="wish-product-image-container">
                <img loading="lazy" src="{{ asset('storage/images/products/'.$product->Images[0]->image) }}" alt="">
            </div>
        </a>
    </div>

    <div class="col-md-8">
        <a href="{{ url('product/'.$product->id) }}" target="_blank">
            <span class="wish-product-title font-weight-500 color-0066c0">{{ $product->product_name }}</span>
        </a>
        {{-- Mrp - Price - Dsicount --}}
        <div class="details-price">
            <span class="text-muted" style="font-size: 15px;"><font class="rupees"><s>&#8377;</font> {{ number_format($product->product_mrp, 2, ".", ",") }}</s></span>
            <br>
            <span><font class="rupees" style="font-size: 18px">&#8377;</font> <span style="font-size: 18px;">{{ number_format($product->product_price, 2, ".", ",") }}</span> 
                <b style="font-size: 15px; color: #388e3c; font-weight: 500;">
                    {{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100) }}% off
                </b>  
            </span>

            <div>
                <span wire:click="$emit('ToggleCart', {{$product->id}})" class="@if(isset($product->carted)) static-red @else hover-blue  @endif">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    @if(isset($product->carted)) Remove From Cart @else Add To Cart @endif
                </span>
            </div>

        </div>
    </div>
            
    <div class="col-md-1">
        <div class="wishlist-remove-btn-container">
            <div>
                <a class="cursor-pointer" wire:click="$emit('ToggleWishlist', {{$product->id}})" target="_blank">
                    <span>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </span>
                </a>
            </div>                            
        </div>
    </div>


</div>

<div class="account-menu-break" id="WishBreak{{$product->id}}"></div> {{-- Underline --}}
