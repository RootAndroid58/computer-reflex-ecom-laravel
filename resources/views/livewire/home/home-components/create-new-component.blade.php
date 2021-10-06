<div>

    <!-- Modal -->
    <div class="modal fade" id="NewComponentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Component</h5>
                    <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Layout</span>
                                    </div>
                                    <select class="custom-select form-control @error('layout') is-invalid @enderror" wire:model="layout" id="layout">
                                      <option value="three_col_banner">Three Column Banner</option>
                                      <option value="full_width_banner">Full Width Banner</option>
                                      <option value="products_carousel_slider">Products Carousel Slider</option>
                                    </select>
                                    @error('layout')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group form-check">
                                    <input type="checkbox" wire:model.defer="visibility" class="form-check-input cursor-pointer @error('visibility') is-invalid @enderror" id="visibility">
                                    <label class="form-check-label cursor-pointer" for="visibility">Publicly Visible</label>
                                    @error('visibility')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>  
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Margin Top</span>
                                    </div>
                                    <input wire:model="marginTop" type="text" class="form-control @error('marginTop') is-invalid @enderror" >
                                    <div class="input-group-append">
                                        <select wire:model="marginTopUnit" class="form-control" style="border-top-left-radius: 0; border-bottom-left-radius: 0; ">
                                            <option value="px">px</option>
                                            <option value="in">in</option>
                                            <option value="rem">rem</option>
                                            <option value="vh">vh</option>
                                        </select>
                                        @error('marginTop')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Margin Bottom</span>
                                    </div>
                                    <input wire:model="marginBottom" type="text" class="form-control @error('marginBottom') is-invalid @enderror" >
                                    <div class="input-group-append">
                                        <select wire:model="marginBottomUnit" class="form-control" style="border-top-left-radius: 0; border-bottom-left-radius: 0; ">
                                            <option value="px">px</option>
                                            <option value="in">in</option>
                                            <option value="rem">rem</option>
                                            <option value="vh">vh</option>
                                        </select>
                                        @error('marginBottom')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                  </div>
                            </div>
                        </div>

                        @if (isset($layout))
                        <div class="w-100 text-center mt-1 mb-3">
                            <span style="font-size: 18px; font-weight: 500;">Component Preview</span>
                            <div style="font-size: 9px;" wire:loading wire:target="layout" class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only" >Loading...</span>
                            </div>
                        </div>
                        
                            @if ($layout == 'three_col_banner')
                            <div class="row">
                                @php $counter = 0; @endphp
                                @while ($counter < 3)
                                <div class="col-4">
                                    <img style="width: 100%" src="{{ asset('storage/images/banner/image-8-5.png') }}" alt="" srcset="">
                                </div>
                                @php $counter++; @endphp
                                @endwhile
                            </div>

                            @elseif($layout == 'full_width_banner')
                            <div>
                                <img loading="lazy" style="width: 100%" src="{{ asset('storage/images/banner/image-9-2.png') }}" alt="" srcset="">
                            </div>
                            
                            @elseif($layout == 'products_carousel_slider')
                            <div>
                                <img loading="lazy" class="w-100 selectDisable" src="{{ asset('img/demo-products-carousel.png') }}" >
                            </div>
                            @endif

                        @endif

                        {{-- @if ($layout == 'three_col_banner' || $layout == 'full_width_banner') --}}
                        <div class="mt-3 text-center">
                            <span class=" text-muted">
                                <i class="fad fa-info-circle"></i>
                                On creating a dummy component would be created, <br> you can edit & change position as per requirements later. 
                            </span>
                        </div>
                        {{-- @endif --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="create">Create</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="electronic-banner-area home-component">
        <div class="d-flex justify-content-center align-items-center manage-components">    
            <span class="btn btn-outline-dark" data-toggle="modal" data-target="#NewComponentModal">
                Create New Component
            </span>
        </div>
    </div>
    
</div>
