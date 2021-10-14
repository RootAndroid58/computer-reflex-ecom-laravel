<div class="livewire-root-div" 
style="
    margin-top: {{ $component->style->marginTop->value.$component->style->marginTop->unit }};
    margin-bottom: {{ $component->style->marginBottom->value.$component->style->marginBottom->unit }};
">

  

    @canany(['Manage UI', 'Master Admin'])
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="EditComponentModal-{{ $component->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Component (Products Carousel Slider)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group form-check">
                            <input type="checkbox" wire:model="visibility" class="form-check-input cursor-pointer @error('visibility') is-invalid @enderror" id="visibilityCheckBox-{{ $component->id }}">
                            <label class="form-check-label cursor-pointer" for="visibilityCheckBox-{{ $component->id }}">Component Publicly Visible</label>
                            @error('visibility')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <input wire:loading.remove wire:target="editTitle" wire:model="editTitle" class="cursor-pointer" type="checkbox" aria-label="Checkbox for following text input">
                                            <i wire:loading wire:target="editTitle" class="fad fa-spin fa-spinner-third"></i>
                                            <span class="ml-2">Title</span> 
                                        </span>
                                    </div>
                                  <input type="text" wire:model.lazy="title" @if (!$editTitle) readonly @endif 
                                    class="form-control @error('title') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <input wire:loading.remove wire:target="editCaption" wire:model="editCaption" class="cursor-pointer" type="checkbox" aria-label="Checkbox for following text input">
                                            <i wire:loading wire:target="editCaption" class="fad fa-spin fa-spinner-third"></i>
                                            <span class="ml-2">Caption</span> 
                                        </span>
                                    </div>
                                  <input type="text" wire:model.lazy="caption"  @if (!$editCaption) readonly @endif 
                                    class="form-control @error('caption') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                    @error('caption')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 ">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <input wire:loading.remove wire:target="editMarginTop" wire:model="editMarginTop" class="cursor-pointer" type="checkbox" aria-label="Checkbox for following text input">
                                            <i wire:loading wire:target="editMarginTop" class="fad fa-spin fa-spinner-third"></i>
                                            <span class="ml-2">Margin Top</span> 
                                        </span>
                                    </div>
                                <input type="text" wire:model.lazy="marginTop"  @if (!$editMarginTop) readonly @endif 
                                    class="form-control @error('marginTop') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                    <div class="input-group-append">
                                        <select wire:model="marginTopUnit" class="form-control" @if (!$editMarginTop) disabled @endif  style="border-top-left-radius: 0; border-bottom-left-radius: 0; ">
                                            <option value="px">px</option>
                                            <option value="in">in</option>
                                            <option value="rem">rem</option>
                                            <option value="vh">vh</option>
                                        </select>
                                    </div>
                                    @error('marginTop')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <input wire:loading.remove wire:target="editMarginBottom" wire:model="editMarginBottom" class="cursor-pointer" type="checkbox" aria-label="Checkbox for following text input">
                                            <i wire:loading wire:target="editMarginBottom" class="fad fa-spin fa-spinner-third"></i>
                                            <span class="ml-2">Margin Bottom</span> 
                                        </span>
                                    </div>
                                  <input type="text" wire:model.lazy="marginBottom"  @if (!$editMarginBottom) readonly @endif 
                                    class="form-control @error('marginBottom') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                                    <div class="input-group-append">
                                        <select wire:model="marginBottomUnit" class="form-control" @if (!$editMarginBottom) disabled @endif  style="border-top-left-radius: 0; border-bottom-left-radius: 0; ">
                                            <option value="px">px</option>
                                            <option value="in">in</option>
                                            <option value="rem">rem</option>
                                            <option value="vh">vh</option>
                                        </select>
                                    </div>
                                    @error('marginBottom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        @if (count($addedProducts))
                        <div class="w-100 d-flex mb-3" style="overflow-x: scroll; min-height: 260px;">
                            @foreach ($addedProducts as $product)
                            <div style="padding: 15px; width: 175px;" class="text-center ">
                                
                                <div class="hoverChangeImgContainer">
                                    <div class="sm-prod-img-container prod-back-div ratio-4-4-padding @if(isset($product->images[1])) childImage @endif transition-low" style="background-image: url('{{ productImage($product->images[0] ?? null) }}');"></div>
                                    @if (isset($product->images[1]))
                                    <div class="sm-prod-img-container prod-back-div ratio-4-4-padding childImage transition-low" style="background-image: url('{{ productImage($product->images[1]) }}');"></div>
                                    @endif
                                </div>
                                
                                <div class="line-limit-3 w-100 text-center d-flex align-items-center " style="height: 67px">
                                    {{$product->product_name}}
                                </div>
                                <a href="{{ route('edit-product', $product->id) }}" target="_blank" class="btn btn-block btn-outline-dark btn-sm">Edit</a>
                                <button type="button" class="btn btn-block btn-danger btn-sm" wire:click="removeProduct('{{$product->id}}')">Remove</button>
                            </div>
                            @endforeach
                        </div>

                        @else
                        <div class="w-100 h-100 mb-3 d-flex justify-content-center align-items-center" style="min-height: 277.5px;">
                            <div class="text-center">
                                <div><i class="fas fa-exclamation-circle" style="font-size: 24px;"></i></div>
                                <div>No Products Added!</div>
                                <div>Please Add Some Products...</div>
                            </div>
                        </div>
                        @endif

                        <div class="input-group products-dropdown-container position-relative">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i wire:loading.remove wire:target="search" class="fad fa-search"></i>
                                    <i wire:loading wire:target="search" class="fad fa-spin fa-spinner-third"></i>
                                </span>
                              </div>
                            <input wire:model.debounce.1000ms="search" class="form-control products-dropdown-search" placeholder="Search for product...">
                        </div>
                        <ul class="w-100  bg-light products-dropdown-ul overflow-auto" style="height: 200px;">
                            @foreach ($searchedProducts as $product)
                            <li  class="pl-3 pr-3 pt-2 pb-2 border-bottom">
                                <div  class="row">
                                    <div  class="col-2">
                                        <div  class="w-100 h-100 d-flex align-items-center">
                                            <img  class="w-100" src="{{ productImage($product->images[0] ?? null) }}">
                                        </div>
                                    </div>
                                    <div  class="col-7">
                                        <div  class="h-100 w-100 d-flex align-items-center">
                                            {{ $product->product_name }}
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div  class="h-100 w-100 d-flex align-items-center justify-content-center">
                                            @if (in_array($product->id, $addedProductIds))  
                                            <button wire:click="removeProduct('{{ $product->id }}')" class="btn btn-sm btn-danger">Remove</button>
                                            @else 
                                            <button wire:click="addProduct('{{ $product->id }}')" class="btn btn-sm btn-primary">Add To Carousel</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="edit">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    @endcanany

    



    <div class="electronic-banner-area">
        <div class="row">
            <div class="col-12">
                <div class="bbb_main_container p-0">
                    <div class="bbb_viewed_title_container " selectDisable > 
                        <h4 class="bbb_viewed_title " style="margin-bottom: 5px; @if (isMobile()) font-size: 20px; @endif">{{ $component->data->title }}
                            @canany(['Manage UI', 'Master Admin'])
                            <span style="font-size: 14px;">
                                <span class="text-danger cursor-pointer ml-1" data-toggle="modal" data-target="#DeleteComponentModal" wire:click="$emitUp('deleteComponentInit', {{ $component->id }})">Delete <i class="fas fa-trash-alt"></i></span> 
                                <span class="text-primary cursor-pointer ml-1" data-toggle="modal" data-target="#EditComponentModal-{{ $component->id }}">Edit <i class="fas fa-edit"></i></span> 
                                <span class="text-dark cursor-pointer ml-1" wire:sortable.handle>Move <i class="fas fa-arrows-alt-v"></i></span> 
                            </span>
                            @endcanany
                        </h4>
                        
                        <div class="bbb_viewed_nav_container float-right" style="position: unset;">
                            <div class="bbb_viewed_nav bbb_viewed_prev" onclick="PrevCarousel({{ $component->id }})"><i class="fas fa-chevron-left"></i></div>
                            <div class="bbb_viewed_nav bbb_viewed_next" onclick="NextCarousel({{ $component->id }})"><i class="fas fa-chevron-right"></i></div>
                        </div>
                        <div class="mb-2">
                            <span >{{ $component->data->caption }}</span>
                        </div>
                    </div>
                    



                    @if (count($component->data->products))
                    <div class="bbb_viewed_slider_container pt-0">
                        <div class=" owl-carousel owl-carousel-{{ $component->id }} owl-theme bbb_viewed_slider bbb_viewed_slider_{{ $component->id }}">
                            @foreach ($component->data->products as $product)  
                            <div class="owl-item">
                                <div class=" product-wrapper right-bottom-shadow mb-3 " style="height: 100%; position: relative;">
                                    <div class="product-img">
                                        <a href="{{route('product-index', $product->id)}}" target="_blank">
                                            
                                            <div class="hoverChangeImgContainer">
                                                <div class="sm-prod-img-container prod-back-div ratio-4-4-padding @if(isset($product->images[1])) childImage @endif transition-low" style="background-image: url('{{ productImage($product->images[0] ?? null) }}');"></div>
                                                @if (isset($product->images[1]))
                                                <div class="sm-prod-img-container prod-back-div ratio-4-4-padding childImage transition-low" style="background-image: url('{{ asset('storage/images/products/'.$product->images[1]->image) }}');"></div>
                                                @endif
                                            </div>

                                        </a>
                                    </div>
                                    
                                    <div class="w-100 text-center pt-3">
                                        <div class="product-action-electro">
                                            <a class="animate-top cursor-pointer cart-btn-b cart-btn-b{{$product->id}} @if($product->carted) cart-btn-active @endif" title="Add To Cart" wire:click="$emit('ToggleCart', {{$product->id}})">
                                                <i class="pe-7s-cart"></i>
                                            </a>    
                                            @if(Auth::check())
                                            <a class=" animate-left cursor-pointer wishlist-btn-b wishlist-btn-b{{$product->id}} @if($product->wishlisted) wishlist-btn-active @endif" title="Wishlist" wire:click="$emit('ToggleWishlist', {{$product->id}})">
                                                <i class="pe-7s-like"></i>
                                            </a>
                                            @endif
                                            
                                            <a class="animate-right cursor-pointer compare-btn-b compare-btn-b{{$product->id}} @if($product->compared) compare-btn-active @endif" title="Compare" wire:click="$emit('ToggleCompare', {{$product->id}})">
                                                <i class="pe-7s-repeat"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="w-100 mt-2 text-center">
                                        <div class="product-rating-4">
                                            <i class="icofont icofont-star @if ($product->avgStars >= 1) yellow @endif"></i>
                                            <i class="icofont icofont-star @if ($product->avgStars >= 2) yellow @endif"></i>
                                            <i class="icofont icofont-star @if ($product->avgStars >= 3) yellow @endif"></i>
                                            <i class="icofont icofont-star @if ($product->avgStars >= 4) yellow @endif"></i>
                                            <i class="icofont icofont-star @if ($product->avgStars >= 5) yellow @endif"></i>
                                        </div>
                                    </div>
                                    <div style="height: 20px;" class="text-center">
                                    @if ($product->product_stock < 1)
                                    <span class="text-danger font-weight-bold" style="font-size: 15px;">
                                        Out Of Stock
                                    </span>
                                    @endif
                                    </div>
                                    <div class="product-content text-center pt-0 ">
                                        <a href="{{route('product-index', $product->id)}}">
                                            <span class="line-limit-3" style="font-size: 15px; font-weight: 600; height: 72px;">
                                                <span>
                                                    {{$product->product_name}}
                                                </span>
                                            </span>
                                        </a>
                                        <span><font class="rupees">₹</font> 
                                            {{$product->product_price}}
                                            <b style="font-size: 17px; color: #388e3c; font-weight: 500;">
                                                {{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100) }}% off
                                            </b>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            @endforeach
                        </div>
                    </div>
                    @else


                    <div class="w-100 text-center bg-light d-flex align-items-center justify-content-center selectDisable" style="height: 150px;">
                        <span class="font-weight-500 "> 
                            <i class="fas fa-exclamation-circle" style="font-size: 24px;"></i><br>
                            This Component Currently Has <br> No Products To Show! <br>
                        </span>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    initProductCarousel({{$component->id}});
</script>
@endpush
