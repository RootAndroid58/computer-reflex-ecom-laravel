<div>

    <!-- Modal -->
        <div wire:ignore.self class="modal " id="newBannerModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Banner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text">Banner Type</label>
                            </div>
                            <select class=" form-control @error('bannerType') is-invalid @enderror" wire:model="bannerType">
                              <option selected disabled>Choose...</option>
                              <option value="imageOnly">Image Only</option>
                              <option value="imageText">Image & Text</option>   
                            </select>
                            @error('bannerType') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="mb-0">Banner Name <font color="red">*</font></label>
                            <input wire:model="bannerName" type="text"
                              class="form-control @error('bannerName') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                            <small class="form-text text-muted">Just for future reference. (Not visible publicly)</small>
                            @error('bannerName') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="custom-file">
                              <input wire:model="bannerImage" type="file" class="custom-file-input form-control @error('bannerImage') is-invalid @enderror">
                              <label class="custom-file-label">
                                @if (isset($bannerImage))
                                    {{$bannerImage->getClientOriginalName()}}
                                @else 
                                    Upload Banner Image
                                @endif
                            
                                </label>
                            </div>
                            @error('bannerImage') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>        
                        
                        

                        @if ($bannerType == 'imageText')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label class="mb-0">Header <font color="red">*</font></label>
                                <input wire:model="header" type="text"
                                    class="form-control @error('header') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                    @error('header') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                <label class="mb-0">Header Line 2 <font color="red">*</font></label>
                                <input wire:model="header2" type="text"
                                    class="form-control @error('header2') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                    @error('header2') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="mb-0">Caption <font color="red">*</font></label>
                            <input wire:model="caption" type="text"
                              class="form-control @error('caption') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                              @error('caption') 
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                        </div>

                        <div class="form-group">
                            <label class="mb-0">Button Text <font color="red">*</font></label>
                            <input wire:model="buttonText" type="text"
                                class="form-control @error('buttonText') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                @error('buttonText') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                        @endif
                        
                
                        <div class="form-group">
                            <label class="mb-0">Button Link <font color="red">*</font></label>
                            <input wire:model="buttonLink" type="text"
                                class="form-control @error('buttonLink') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                @error('buttonLink') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" wire:click="create">Create Banner  </button>
                    </div>
                </div>
            </div>
        </div>



    
    <!-- Modal -->
    <div wire:ignore>
        <div class="modal" id="bannerDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">
                        <div wire:loading wire:target="deleteBannerById" class="w-100 text-center" style="font-size: 24px;">
                            <i class="fad fa-circle-notch fa-spin"></i>
                        </div>
                        <div wire:loading.remove wire:target="deleteBannerById">
                            <strong>
                                Are you sure, wanna <span class="text-danger">delete</span> this banner?
                            </strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:click="deleteBanner" type="button" data-dismiss="modal" class="btn btn-danger position-relative" wire:loading.attr="disabled" wire:target="deleteBannerById">
                            Delete <i class="fad fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    











    {{-- Buttons Row Start --}}
    <div class="w-100 text-right">
        <button class="btn btn-sm btn-dark" data-target="#newBannerModal" data-toggle="modal">New Banner</button>
    </div>



    

    <div wire:sortable="updatePosition" class="mt-3">

        @if (count($banners) < 1)
            <div class="alert alert-secondary" role="alert">
                <strong>No Banners Exists <span data-toggle="modal" data-target="#newBannerModal" class="btn-link cursor-pointer">Create One!</span></strong>
            </div>
        @endif
           
        @foreach ($banners as $banner)
        
        <div class="">
            <div wire:sortable.item="{{ $banner->id }}" wire:key="carousel-home-banner-{{ $banner->id }}" class="row mb-3 HomeCarouselSortable">
            
                <div wire:sortable.handle class="col-1 d-flex justify-content-center align-items-center cursor-pointer">
                    <div style="font-size: 24px;" wire:key="handle-{{ $banner->id }}">
                        <i class="fad fa-bars" wire:loading.remove wire:target="updatePosition"></i>
                        <i class="fad fa-circle-notch fa-spin" wire:loading wire:target="updatePosition"></i>
                    </div>
                </div>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    <p class="custom-control custom-switch custom-switch-lg m-0">
                        <input class="custom-control-input" type="checkbox" id="toggleBtn-{{$banner->id}}" wire:change="toggleBannerStatus('{{ $banner->id }}')" @if ($banner->banner_status == true) checked @endif>
                        <label class="custom-control-label font-italic" for="toggleBtn-{{$banner->id}}"></label>
                    </p>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="w-100">
                        <div>
                            <span style="font-weight: 500; font-size: 18px; color: #383838;">{{$banner->banner_name}} </span>
                            <div>{{ $banner->caption }}</div>
                            <div class="mt-2"><span style="font-weight: 600;">Created:</span> {{ $banner->created_at }}</div>
                            <div><span style="font-weight: 600;">Updated:</span> {{ $banner->updated_at }}</div>
                            
                            <div class="d-flex mt-2" >
                                <div style="width: 50%">
                                    <span data-toggle="modal" data-target="#editBannerModal" class="btn btn-dark btn-sm btn-block">Edit &nbsp;<i class="fad fa-edit"></i></span>
                                </div>
                                <div style="width: 50%">
                                    <button data-toggle="modal" data-target="#bannerDeleteModal" wire:click="deleteBannerById('{{ $banner->id }}')" class="btn btn-outline-danger btn-sm btn-block">Delete &nbsp;<i class="fad fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="w-100 d-flex no-scroll" style="overflow-x: scroll;">
                        <div style="padding: 15px; width: 175px;" class="text-center">
                            <div style="height: 100px;" class="w-100 text-center">
                                <img class="w-100" src="{{ asset('storage/images/banner/'.$banner->banner_img) }}" style="max-height: 100%;">
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
      
        @endforeach
    </div>
</div>
