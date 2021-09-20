<div class="custom-col-style-2 electronic-banner-col-3 mb-30">
    <div class="div-shadow">
        <a href="{{ $SmallBanner->link }}">
            <div class="electronic-banner-wrapper">
                <img loading="lazy" style="height: 100%; width: 100%;" src="{{ $SmallBanner->image }}" alt="Small Banner Image">
            </div>
        </a>

        @canany(['Manage UI', 'Master Admin'])
        <div>
            <span class="cursor-pointer static-blue float-right "  onclick="EditSmallBanner({{ $SmallBanner->id }})">Edit</span>
        </div>
        @endcanany
    </div> 
    
</div>