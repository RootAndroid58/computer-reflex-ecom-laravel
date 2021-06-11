<div>
    <div class="wishlist-basic-padding">
        <div class="account-details-title" style="padding-bottom: 0px;">
            <span>{{ FirstWord(Auth()->user()->name) }}'s Wishlist ({{ $wishlist->total() }})</span>
        </div>
    </div>

    <div class="account-menu-break"></div> {{-- Underline --}}

    @if (!isset($wishlist[0]))
    <div class="wishlist-container">
        <div class="wishlist-basic-padding">
            <div class="w-100"  >
                <div class="blank-wishlist-container text-center">
                    <div class="blank-wishlist-img-container" style="margin-top: 50px;">
                        <img loading="lazy" class="img-nodrag" style="max-width: 35%" src="{{ asset('img/svg/blank-wishlist.png') }}">
                    </div>
                    <div class="blank-wishlist-txt-container text-center" style="margin-top: 30px;">
                        <span style="font-weight: 500; font-size: 20px;">Empty Wishlist!</span>
                        <br>
                        <span>You have no items in your wishlist. Start adding!</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> 
    @else

    <div class="wishlist-container">
        @foreach ($wishlist as $wishlistItem)
            @livewire('wishlist-product', ['product' => $wishlistItem->Product], key($wishlistItem->Product->id))
        @endforeach
    </div> 
    
    <div class="pt-3 pb-3">
        {{ $wishlist->links('livewire::bootstrap') }}
    </div>
    @endif
</div>