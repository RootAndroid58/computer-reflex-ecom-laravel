<div class="livewire-root-div">

    {{-- {{dd($component->data->title)}} --}}

    @canany(['Manage UI', 'Master Admin'])]
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
                        
                        
                        <!--Products Table Start-->
                        <div wire:ignore>
                            <table id="AdminProductsComponent-{{ $component->id }}" class="table table-striped table-bordered w-100 AdminProductsTable" data-url="{{route('ajax-datatable.AdminSliderProductsTable')}}">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%">Product Name</th>
                                    <th style="width: 15%">Brand</th>
                                    <th style="width: 10%">MRP</th>
                                    <th style="width: 10%">Price</th>
                                    <th style="width: 10%">Stock</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                        
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>MRP</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
    

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endcanany

    
    <div class="electronic-banner-area @if (!isMobile())  @else mb-2 @endif  ">
        <div class="row">
            <div class="col-12" style="padding: 0;">
                <div class="bbb_main_container">
                    <div class="bbb_viewed_title_container " selectDisable > 
                        <h4 class="bbb_viewed_title " style="margin-bottom: 5px; @if (isMobile()) font-size: 20px; @endif">{{ $component->data->title }}
                            @canany(['Manage UI', 'Master Admin'])
                            <span style="font-size: 14px;">
                                <span class="text-primary cursor-pointer ml-1" data-toggle="modal" data-target="#EditComponentModal-{{ $component->id }}">Edit <i class="fas fa-edit"></i></span> 
                                <span class="text-danger cursor-pointer ml-1" data-toggle="modal" data-target="#DeleteComponentModal" wire:click="$emitUp('deleteComponentInit', {{ $component->id }})">Delete <i class="fas fa-trash-alt"></i></span> 
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
                    



                    @if (isset($component->data->products[0]))
                    <div class="bbb_viewed_slider_container ">
                        <div class=" owl-carousel owl-carousel-{{ $component->id }} owl-theme bbb_viewed_slider">
                            @foreach ($component->data->products as $product)  
                            <div class="owl-item">
                                <div class="product-wrapper mb-30">
                                    <div class="product-img">
                                        <a href="{{ route('product-index', $product->id) }}" target="_blank">
                                            <div class="sm-prod-img-container">
                                                <img loading="lazy" class="d-block" style="margin:auto; width: auto; max-width: 100%; max-height: 100%;" src="{{ asset('storage/images/products/'.$product->images[0]->image) }}" alt="" srcset="">
                                            </div>
                                        </a>
                                        <div class="product-action">
                                            <a class="animate-left cursor-pointer wishlist-btn-a wishlist-btn-a{{ $product->id }} @if(isset($product->wishlisted)) wishlist-btn-active @endif " wire:click="$emit('ToggleWishlist', {{ $product->id }})" title="Wishlist"><i class="pe-7s-like"></i></a>
                                            <a class="animate-top cursor-pointer cart-btn-a cart-btn-a{{ $product->id }}  @if(isset($product->carted)) cart-btn-active @endif" wire:click="$emit('ToggleCart', {{ $product->id }})" title="Add To Cart"><i class="pe-7s-cart"></i></a>
                                            <a class="animate-right cursor-pointer compare-btn-a compare-btn-a{{ $product->id }} @if(isset($product->compared)) compare-btn-active @endif" wire:click="$emit('ToggleCompare', {{ $product->id }})" title="Compare"><i class="pe-7s-repeat"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-rating-4" style="text-align: center">
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 1) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 2) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 3) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 4) yellow @endif "></i>
                                        <i class="icofont icofont-star @if (isset($product->stars->stars) && $product->stars->stars >= 5) yellow @endif "></i>
                                    </div>
                                    <div class="product-content" style="text-align: center">
                                        <h4><a class="line-limit-2" href="{{route('product-index', $product->id)}}"> {{$product->product_name}} </a></h4>
                                        <span><font class="rupees">₹</font> 
                                            {{ moneyFormatIndia($product->product_price) }}
                                            <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)}}% off</b>
                                        </span>
                                        @if ($product->product_stock <= 0)
                                            <br>
                                            <span class="text-danger">Out Of Stock</span>
                                        @endif
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
