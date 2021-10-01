<div>
    @if ($page == 'home')
    <div class="trace-cart-wrapper">
        <div class="categories-cart same-style">
            <div class="same-style-icon">
                <a href="{{ route('cart') }}"><i class="pe-7s-cart"></i></a>
            </div>
            <div class="same-style-text">
                <a href="{{ route('cart') }}">My Cart <br>{{ $cartCount }} Item</a>
            </div>
        </div>
    </div>
    @else
    <div id="CartCount">
        <div class="header-cart">
            <a class="icon-cart-furniture" href="{{ route('cart') }}">
                <i class="ti-shopping-cart"></i>
                <span class="shop-count-furniture green">
                    {{ $cartCount }}
                </span>
            </a>
        </div>                         
    </div>
    @endif
</div>

