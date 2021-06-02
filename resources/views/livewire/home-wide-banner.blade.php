<div class="banner-area wrapper-padding pt-30 pb-50" wire:init='DocReady'>
    @if ($isReady)
    <div class="container-fluid">
        <a href="{{ $SmallBanner->link }}">
            <img loading=lazy src="{{  $SmallBanner->image  }}" alt="Oops... Banner Image Not Loaded" width="100%">
        </a>

        @canany(['Manage UI', 'Master Admin'])
        <div>
            <span class="cursor-pointer static-blue float-right"  onclick="EditSmallBanner({{  $SmallBanner->id  }})">Edit</span>
        </div>
        @endcanany
    </div>
    @endif
</div>