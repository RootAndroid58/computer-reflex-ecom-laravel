<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

use Livewire\WithPagination;

class WishlistContainer extends Component
{
    use WithPagination;

    protected $listeners = ['wishlistRemoved' => '$refresh', 'load-more' => 'loadMore'];

    public function render()
    {
        return view('livewire.wishlist-container', [
            'wishlist' => Wishlist::where('user_id', Auth()->user()->id)->with(['Product','Images', 'Cart'])->orderBy('id', 'asc')->paginate(5),
        ]);
    }
}
