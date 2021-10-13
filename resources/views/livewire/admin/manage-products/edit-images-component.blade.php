<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="AddMoreImagesModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add More Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="w-100">

                        <div class="input-group mb-3">
                            <div class="custom-file">
                              <input multiple wire:model="images" type="file" class="custom-file-input form-control-file form-control"  id="imagesUpload">
                              <label class="custom-file-label" for="imagesUpload">Choose Images (Multiple)</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="addImages">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="imageDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="w-100 text-center" wire:loading wire:target="imageDeleteInit">
                        <div class="spinner-border text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                    </div>
                    <div wire:loading.remove wire:target="imageDeleteInit">
                        Are you sure, wanna delete this image?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="imageDelete">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    




    {{-- Header --}}
    <h3>Edit Product Images
        <div class="float-right">
            <a class="btn btn-dark btn-sm" data-target="#AddMoreImagesModal" data-toggle="modal">Add More Imges</a>
            <a class="btn btn-primary btn-sm" href="{{ route('edit-product', $product->id)}}">Edit Product Details</a>
        </div>
    </h3>
    <span>{{$product->product_name}}</span>
    




        <div class="container" wire:sortable="updatePosition" 
        animation="1000"
        ghost-class="d-none">
            @foreach ($product->images as $image)
            <div class="row mt-3" wire:sortable.item="{{ $image->id }}" wire:key="product-image-{{ $image->id }}">
                <div class="col-1 d-flex justify-content-center align-items-center">
                    <i wire:sortable.handle style="font-size: 24px;" class="fad fa-bars cursor-pointer"></i>
                </div>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    <div class="custom-control custom-switch custom-switch-lg m-0">
                        <input class="custom-control-input" type="checkbox" id="toggleBtn-{{$image->id}}" 
                        @if ($image->active) checked @endif
                        wire:change="toggleImage('{{$image->id}}')">
                        <label class="custom-control-label font-italic" for="toggleBtn-{{$image->id}}"></label>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <div>
                        <div class="mt-2">
                            <span style="font-weight: 600;">Created:</span> {{$image->created_at}}
                        </div>
                        <div>
                            <span style="font-weight: 600;">Updated:</span> {{$image->updated_at}}
                        </div>
                        <button class="btn btn-outline-danger btn-sm btn-block mt-3" data-toggle="modal" data-target="#imageDeleteModal" wire:click="imageDeleteInit('{{$image->id}}')">Delete &nbsp;<i class="fad fa-trash"></i></button>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <img class="w-100" src="{{ asset('storage/images/products/'.$image->image) }}">
                </div>
            </div>
            @endforeach
        </div>

   
    


</div>
