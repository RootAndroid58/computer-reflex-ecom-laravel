<div class="livwire-root-div" >


    {{-- Modal Start --}}
    @canany(['Manage UI', 'Master Admin'])
    <div wire:ignore.self class="modal fade" id="EditComponentModal-{{ $component->id }}" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Component
                        @if ($component->type == 'three_col_banner')
                            (Three Column Banner)
                        @elseif($component->type == 'full_width_banner')
                            (Full Width Banner)
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        {{-- Visibility Checkbox Field --}}
                        <div class="form-group form-check">
                            <input type="checkbox" wire:model.defer="visibility" class="form-check-input cursor-pointer @error('visibility') is-invalid @enderror" id="visibilityCheckBox-{{ $component->id }}">
                            <label class="form-check-label cursor-pointer" for="visibilityCheckBox-{{ $component->id }}">Component Publicly Visible</label>
                            @error('visibility')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- Banner Select Field --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text">Which Banner?</label>
                            </div>
                            <select class="custom-select form-control" wire:model="dataKey">
                                @foreach ($component->data as $key => $data)
                                <option value="{{ $key }}">{{ ordinal($key+1) }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Banner Url Field --}}
                        <div>
                            <label for="url">Banner Url</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span wire:loading wire:target="editUrl" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <input type="checkbox" wire:loading.remove wire:target="editUrl" class="cursor-pointer" wire:model="editUrl">
                                    </div>
                                </div>
                              <input wire:target="editUrl" wire:loading.attr="disabled" @if (!$editUrl) disabled @endif class="form-control @error('url') is-invalid @enderror" wire:model.lazy="url" id="url">
                              @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <small id="fileHelpId" class="form-text text-muted mb-3">Please include <strong>https://</strong> or <strong>http://</strong></small>
                        </div>
                        {{-- Banner Image Upload Field --}}
                        <div>
                            <div class="input-group">
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
                        </div>
                        {{-- Image Preview & Cropping Area --}}
                        <div class="text-center">
                            <div wire:loading wire:target="image" class="spinner-border text-primary mt-3" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div>
                                @if (isset($image) && $editImage)
                                <div wire:loading.remove wire:target="image" class="mt-3">
                                    <div wire:ignore >
                                        <img class="bannerImg" id="bannerImgCrop-{{ $component->id }}" src="{{ $image->temporaryUrl() }}" style="width: 100%;">
                                    </div>
                                </div> 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>  {{-- Modal Body End --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="edit">Save Changes</button>
                </div> 
            </div>
        </div>
    </div>
    @endcanany
    {{-- Modal End --}}



    
    {{-- Three Column Banner --}}
    @if ($component->type == 'three_col_banner')
    <div class="electronic-banner-area" >
        <div class="w-100" style="position: relative;">
            <div class="custom-row-2">
            @foreach ($component->data as $data)
                <div class="custom-col-style-2 col-4">
                    <div class="div-shadow w-100">
                        <a @if (isset($data->link)) href="{{ $data->link }}" @endif class="w-100">
                            <div class="electronic-banner-wrapper w-100">
                                {{-- 8:5 Aspect Ratio (Width:Height) --}}
                                <div class="prod-back-div w-100">
                                    <div class="cover-back hover-back-zoom w-100" style="padding-bottom: 62.5%; background-image: url('{{ asset('storage/images/banner/'.$data->image) }}')"></div>
                                </div>
                            </div>
                        </a>
                    </div> 
                </div>
            @endforeach
            </div>
            @canany(['Manage UI', 'Master Admin'])
                <div class="w-100">
                    <div class="btn-group" role="group" style="position: absolute; top: 0; right: 0;">
                        <span class="btn btn-sm btn-danger" data-toggle="modal" data-target="#DeleteComponentModal" wire:click="$emitUp('deleteComponentInit', {{ $component->id }})">Delete <i class="fad fa-trash"></i></span>
                        <span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditComponentModal-{{ $component->id }}">Edit &nbsp;<i class="fad fa-edit"></i></span>
                        <span class="btn btn-sm btn-dark" wire:sortable.handle>Move <i class="fas fa-arrows-alt-v"></i></span>
                    </div>
                </div>
            @endcanany
        </div>
    </div>
    {{-- Full Width Banner --}}
    @elseif ($component->type == 'full_width_banner')
        @foreach ($component->data as $data)
        <div class="banner-area wrapper-padding " >  {{-- pt-30 pb-30 --}}
            <div class="container-fluid" >
                <div class="w-100" style="position: relative;">
                    <a @if ($data->link) href="{{ $data->link }} @endif">
                        <div class="div-shadow" style="overflow: hidden;">
                            <img loading="lazy" class="hover-zoom hover-zoom-half" style="display: block;" src="{{ asset('storage/images/banner/'.$data->image) }}" width="100%">  
                        </div>
                    </a>
                    @canany(['Manage UI', 'Master Admin'])
                        <div class="w-100">
                            <div class="btn-group" role="group" style="position: absolute; top: 0;  right: 0;">
                                <span class="btn btn-sm btn-danger" data-toggle="modal" data-target="#DeleteComponentModal" wire:click="$emitUp('deleteComponentInit', {{ $component->id }})">Delete <i class="fad fa-trash"></i></span>
                                <span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditComponentModal-{{ $component->id }}">Edit &nbsp;<i class="fad fa-edit"></i></span>
                                <span class="btn btn-sm btn-dark" wire:sortable.handle>Move <i class="fas fa-arrows-alt-v"></i></span>
                            </div>
                        </div>
                    @endcanany
                </div>
            </div>
        </div>
        @endforeach
    @endif


</div>  

