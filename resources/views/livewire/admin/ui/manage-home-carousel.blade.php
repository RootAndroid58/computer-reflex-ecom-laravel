<div>

    
    <!-- Modal -->
    <div wire:ignore>
        <div class="modal fade" id="sectionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div wire:loading wire:target="deleteSectionById" class="w-100 text-center" style="font-size: 24px;">
                            <i class="fad fa-circle-notch fa-spin"></i>
                        </div>
                        <div wire:loading.remove wire:target="deleteSectionById">
                            <strong>
                                Are you sure, wanna <span class="text-danger">delete</span> this section?
                            </strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:click="deleteSection" type="button" data-dismiss="modal" class="btn btn-danger position-relative" wire:loading.attr="disabled" wire:target="deleteSectionById">
                            Delete <i class="fad fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    
    </div>


    <div wire:sortable="updatePosition" class="mt-3">

        @if (count($HomeSections) < 1)
            <div class="alert alert-secondary" role="alert">
                <strong>No Carousel Sliders Exists <a href="{{ route('admin-create-home-carousel-slider') }}" class="btn-link">Create One!</a></strong>
            </div>
        @endif

        @foreach ($HomeSections as $HomeSection)
        <div wire:sortable.item="{{ $HomeSection->id }}" wire:key="carousel-home-section-{{ $HomeSection->id }}" class="row mb-3 HomeCarouselSortable">
            <div wire:sortable.handle class="col-1 d-flex justify-content-center align-items-center cursor-pointer">
                <div style="font-size: 24px;" wire:key="handle-{{ $HomeSection->id }}">
                    <i class="fad fa-bars" wire:loading.remove wire:target="updatePosition"></i>
                    <i class="fad fa-circle-notch fa-spin" wire:loading wire:target="updatePosition"></i>
                </div>
            </div>
            <div class="col-3 d-flex justify-content-center align-items-center">
                <div class="w-100">
                    <div>
                        <span style="font-weight: 500; font-size: 18px; color: #383838;">{{$HomeSection->title}} </span>
                        <div>{{ $HomeSection->caption }}</div>
                        <div class="mt-2"><span style="font-weight: 600;">Created:</span> {{ $HomeSection->created_at }}</div>
                        <div><span style="font-weight: 600;">Updated:</span> {{ $HomeSection->updated_at }}</div>
                        
                        <div class="d-flex mt-2" >
                            <div style="width: 50%">
                                <a href="{{route('admin-edit-home-carousel-slider', $HomeSection->id)}}" class="btn btn-dark btn-sm btn-block">Edit &nbsp;<i class="fad fa-edit"></i></a>
                            </div>
                            <div style="width: 50%">
                                <button data-toggle="modal" data-target="#sectionDeleteModal" wire:click="deleteSectionById('{{ $HomeSection->id }}')" class="btn btn-outline-danger btn-sm btn-block">Delete &nbsp;<i class="fad fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="w-100 d-flex no-scroll" style="overflow-x: scroll;">
                    @foreach ($HomeSection->products as $product)
                        <div style="padding: 15px; width: 175px;" class="text-center">
                            <div style="height: 100px;" class="w-100 text-center">
                                <img class="w-100" src="{{ asset('storage/images/products/'.$product->images[0]->image) }}" style="max-height: 100%;">
                            </div>
                        </div>
                    @endforeach
                </div> 
            </div>
        </div>
        @endforeach
    </div>
</div>
