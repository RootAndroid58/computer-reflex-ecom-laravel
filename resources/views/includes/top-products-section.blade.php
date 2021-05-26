<div class="col-6" style="padding: 0;">
    <div style="padding: 0px 6px;" class="product-border">
        <div class="product-wrapper mb-24">
            <div class="product-img-3">
                <a href="{{ route('product-index', $product->id) }}" >
                    <div class="prod-back-div" 
                        style="width: 100%; height: 110px; 
                        background-image: url('{{asset('storage/images/products/'.$product->images[0]->image)}}');">
                    </div>
                </a>
                <div class="product-action-right">
                    <a class="animate-right cursor-pointer" title="Quick View" onclick="ToggleCompare({{ $product->id }})">
                        <i class="pe-7s-repeat"></i>
                    </a>
                    <a class="animate-top cursor-pointer" title="Add To Cart" onclick="ToggleCart({{ $product->id }})">
                        <i class="pe-7s-cart"></i>
                    </a>
                    <a class="animate-left cursor-pointer" title="Wishlist" onclick="ToggleWishlist({{ $product->id }})">
                        <i class="pe-7s-like"></i>
                    </a>
                </div>
            </div>
            <div class="product-content-4 text-center" style="padding: 0;">
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
</div>