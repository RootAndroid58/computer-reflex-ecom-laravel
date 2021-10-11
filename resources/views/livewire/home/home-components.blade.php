<div>
    
    <!-- Modal -->
    @canany(['Manage UI', 'Master Admin'])
    <div wire:ignore.self class="modal fade" data-keyboard="false" id="DeleteComponentModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Component Delete Confirmation <span wire:loading><i class="fad fa-spin fast-spin fa-spinner-third"></i></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        Are you sure wanna delete this component (Full Width Banner) ?
                    </span>
                </div>
                <div class="modal-footer">
                    <span type="button" class="btn btn-secondary" data-dismiss="modal">Close</span>
                    <span type="button" class="btn btn-danger" wire:loading.attr="disabled" wire:click="deleteComponent">Yes, Delete</span>
                </div>
            </div>
        </div>
    </div>  
    @endcanany


    <div @canany(['Manage UI', 'Master Admin']) wire:sortable="updatePosition" @endcanany>
    @foreach ($components as $component)
        @if ($component->visible || Auth::check() && Auth()->user()->hasAnyPermission(['Master Admin', 'Manage UI']))
            <div wire:sortable.item="{{ $component->id }}" wire:key="home-component-container-{{ $component->id }}" >
                @if ($component->type == 'three_col_banner' || $component->type == 'full_width_banner')
                    @livewire('home.home-components.banner-component', ['component' => $component], key('home-component-id-'.$component))
                @elseif ($component->type == 'products_carousel_slider')
                    @livewire('home.home-components.products-carousel-component', ['component' => $component], key('home-component-id-'.$component))
                @endif
            </div>
        @endif
    @endforeach
    </div>

    @canany(['Manage UI', 'Master Admin'])
        @livewire('home.home-components.create-new-component', key('create-home-component'))
    @endcanany

</div>


