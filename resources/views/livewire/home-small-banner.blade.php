<div @if ($type == 'small') class="custom-col-style-2 col-4 mb-30" @endif >

    {{-- Banner Edit Modal (Admin Only) --}}
    @canany(['Manage UI', 'Master Admin'])
    <div wire:ignore.self class="modal SmallBannerEditModal-{{ $SmallBanner->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit Banner</strong> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div>


                        <label for="url">Banner Url</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span wire:loading wire:target="editUrl" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <input type="checkbox" wire:loading.remove wire:target="editUrl" class="cursor-pointer" wire:model="editUrl">
                                </div>
                            </div>
                          <input wire:target="editUrl" wire:loading.attr="disabled" @if (!$editUrl) disabled @endif class="form-control @error('url') is-invalid @enderror" wire:model="url" id="url">
                            @error('url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                          
                        </div>
                        <small id="fileHelpId" class="form-text text-muted mb-3">Please include <strong>https://</strong> or <strong>http://</strong></small>
                        


                        <div class="input-group">
                          {{-- <label for="image"></label> --}}
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span wire:loading wire:target="editImage" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <input type="checkbox" wire:loading.remove wire:target="editImage" class="cursor-pointer"  wire:model="editImage">
                            </div>
                          </div>
                          <input type="file" wire:target="editImage" wire:loading.attr="disabled" @if (!$editImage) disabled @endif wire:model="image" id="image" class="form-control-file form-control @error('image') is-invalid @enderror" style="height: unset;" >
                          @error('image')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <small id="fileHelpId" class="form-text text-muted">Recommended: <strong>8:5</strong> (Width:Height) Aspect Ratio</small>
                        

                        <div class="text-center">
                            {{-- {{ $x }} {{ $y  }} {{ $width }}  {{ $height }} --}}
                            <div wire:loading wire:target="image" class="spinner-border text-primary mt-3" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>


                            <div>
                                @if (isset($image) && $editImage)
                                <div wire:loading.remove wire:target="image" class="mt-3">
                                    <div wire:ignore >
                                        <img class="bannerImg" id="cropperImg-{{ $SmallBanner->id }}" src="{{ $image->temporaryUrl() }}" style="width: 100%;">
                                    </div>
                                </div> 
                                @endif
                            </div>

                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <span type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="submit">Save Changes</span>
                </div>
            </div>
        </div>
    </div>
    @endcanany




    {{-- Banner Display Area --}}
    @if ($type == 'wide')
    <div class="banner-area wrapper-padding pt-30 pb-30" >
        <div class="container-fluid">
            <a href="{{ $SmallBanner->link }}">
                <img class="div-shadow" loading=lazy src="{{  $SmallBanner->image  }}" alt="Oops... Banner Image Not Loaded" width="100%">
            </a>
            @canany(['Manage UI', 'Master Admin'])
            <div>
                <span class="cursor-pointer static-blue float-right" data-toggle="modal" data-target=".SmallBannerEditModal-{{ $SmallBanner->id }}">Edit</span>
            </div>
            @endcanany
        </div>
    </div>
    @elseif (($type == 'small'))
        <div class="div-shadow">
            <a href="{{ $SmallBanner->link }}">
                <div class="electronic-banner-wrapper">
                    {{-- 8:5 Aspect Ratio (Width:Height) --}}
                    <div class="prod-back-div">
                        <div class="cover-back hover-back-zoom" style="width: 100%;
                            padding-bottom: 62.5%;
                            background-image: url('{{ asset('storage/images/banner/'.$SmallBanner->image) }}')">
                        </div>
                    </div>
                </div>
            </a>

            @canany(['Manage UI', 'Master Admin'])
            <div class="mt-1">
                <span class="cursor-pointer static-blue float-right " data-toggle="modal" data-target=".SmallBannerEditModal-{{ $SmallBanner->id }}" >Edit</span>
            </div>
            @endcanany
        </div> 
    @endif

    <script>
        Livewire.on('cropperInit-{{ $SmallBanner->id }}', e => {
            console.log('CropperJS Initiated. 🟢')
            var image = $('#cropperImg-{{ $SmallBanner->id }}');

            image.cropper('destroy').attr('src', e['imageUrl']).cropper({
                aspectRatio: 8/5,
                autoCropArea: 1,
                viewMode: 1,
                crop (e) {
                    @this.set('x', e.detail.x, true)
                    @this.set('y', e.detail.y, true)
                    @this.set('width', e.detail.width, true)
                    @this.set('height', e.detail.height, true)
                }
            });
        });
    </script>
</div>

