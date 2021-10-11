<div class="shop-page-wrapper shop-page-padding  pb-50 " livewire-root-div>
    <div class="container-fluid pt-3">
        <div>
        <div class="row" wire:ignore.self>
            {{-- Sidebar Start --}}
            <div class="col custom-col-lg-2 custom-col-md-3" wire:ignore.self>

                <div class="shop-sidebar p-3 bg-light  right-bottom-shadow" style="border-radius: 5px;">

                    <div class="sidebar-widget ">
                        <div class="font-weight-bold mb-2" style="font-size: 15px; color: #383838;" >Filter By Category</div>
                        <div class="sidebar-categories">
                            <div class="form-group">
                                <select wire:model="categoryFilter" class="form-control pl-1 text-center" style="cursor: pointer; height: 25px; padding: 0; font-size: 13px;" >
                                    <option value="all">All</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            
                    <div class="sidebar-widget mb-3">
                        <div class="font-weight-bold mb-2" style="font-size: 15px; color: #383838;" >Filter By Price</div>
                        <div class="price_filter">
                            <div class="price_slider_amount">
                                <div class="_2b0bUo">
                                    <div class="_1YAKP4 text-center">
                                        <input type="number" wire:model="minPrice" class="_2YxCDZ" value="{{ request()->min_price ?? '' }}">
                                        <small id="helpId" class="form-text text-muted">Min Price</small>
                                    </div>
                                    <div class="_3zohzR" style="margin-bottom: 20px;">To</div>
                                    <div class="_3uDYxP  text-center">
                                        <input type="number" wire:model="maxPrice" class="_2YxCDZ" value="{{ request()->max_price ?? '' }}">
                                        <small id="helpId" class="form-text text-muted">Max Price</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget mb-4">
                        <div class="font-weight-bold mb-2" style="font-size: 15px; color: #383838;" >Availability</div>
                        <div class="form-check">
                            <input wire:model="showOutOfStock" class="form-check-input cursor-pointer" type="checkbox" id="flexCheckDefault" @if(request()->stock == 'checked') checked @endif>
                            <label class="form-check-label cursor-pointer" for="flexCheckDefault" style="font-size: 14px;">
                                Show Out Of Stock Items
                            </label>
                        </div>
                    </div>

                
                    <div class="sidebar-widget ">
                        <div class="font-weight-bold mb-2" style="font-size: 15px; color: #383838;" >Specifications</div>

                            <div class="collapse-item" style="border-bottom: 1px solid rgb(197, 197, 197);">
                                <div wire:ignore.self class="collapse-btn @if(count($brandsFilter)) on @endif" style="padding: 7px 10px; transition: all 200ms; background-color: rgba(212, 212, 212, 0.781);">
                                    <span style="font-weight: 600">Brand</span>
                                </div>
                                <div wire:ignore.self class="collapse-content" style="transition: all 200ms; @if(count($brandsFilter)) max-height: fit-content; @endif" >
                                    @foreach ($brands as $key => $brand)
                                    <div style="padding-top: 6px; padding-bottom: 6px;">
                                        <div class="form-check">
                                            <input class="form-check-input cursor-pointer" wire:change="toggleBrandsFilter({{ $key }})" type="checkbox" id="BrandCheckBox{{ $key }}">
                                            <label class="form-check-label cursor-pointer line-limit-2" for="BrandCheckBox{{ $key }}">{{ $brand }}</label>
                                        </div>
                                    </div>
                                    <div class="account-menu-break"></div>  
                                    @endforeach
                                </div>
                            </div>                         
                            
                            

                            @foreach ($specsGroupArr as $Group => $SpecsGroup)
                            @php
                                $open = false;
                                foreach ($specsFilter as $key => $value) {
                                    $open = in_array($key, $SpecsGroup->pluck('id')->toArray());
                                }
                            @endphp
                    
                            <div class="collapse-item" style="border-bottom: 1px solid rgb(197, 197, 197);">
                                <div wire:ignore.self class="collapse-btn @if($open) on @endif" style="padding: 7px 10px; transition: all 200ms; background-color: rgba(212, 212, 212, 0.781);">
                                    <span style="font-weight: 600">{{ $Group }}</span>
                                </div>
                                <div wire:ignore.self class="collapse-content" style="transition: all 200ms; @if($open) max-height: fit-content; @endif  ">
                                    @foreach ($SpecsGroup as $Specs)
                                        <div style="padding-top: 6px; padding-bottom: 6px;">
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" wire:loading.attr='disabled' wire:target='specsFilter'   
                                                    wire:model="specsFilter.{{ $Specs->id }}"
                                                type="checkbox" id="{{ 'specification-checkbox-'.$Specs->id }}">
                                                <label class="form-check-label cursor-pointer line-limit-2" for="{{ 'specification-checkbox-'.$Specs->id }}">{{ $Specs->specification_value }}</label>
                                            </div>
                                        </div>
                                        <div class="account-menu-break"></div>  
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            
                    </div>
                    
                </div>
              
            </div>
            {{-- Sidebar End --}}




            <div class="col custom-col-lg-10 custom-col-md-9" wire:ignore.self>
                    <div class="shop-product-wrapper res-xl ">
                        <div class="shop-bar-area pl-4">

                            <div class="shop-bar   pl-3">
                                <div class="shop-found-selector">
                                    <div class="shop-found">
                                        <p><span>{{$products->total()}}</span> Products Found</p>
                                    </div>
                                    <div class="shop-selector">
                                        <label for="sort_by_select">Sort By : </label>
                                        <select wire:model="sortBy" id="sort_by_select" style="width: 170px;">
                                            <option value="Default">Relevance</option>
                                            <option value="A to Z">A to Z</option>
                                            <option value="Z to A">Z to A</option>
                                            <option value="Price Low to High">Price Low to High</option>
                                            <option value="Price High to Low">Price High to Low</option>
                                            {{-- <option @if (Request()->sort_by == 'Highest Rating First') selected @endif value="Highest Rating First">Highest Rating First</option>
                                            <option @if (Request()->sort_by == 'Lowest Rating First') selected @endif value="Lowest Rating First">Lowest Rating First</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="shop-filter-tab">
                                    <div class="shop-tab nav" role=tablist>
                                        <a class="active" href="#grid-sidebar3" data-toggle="tab" role="tab" aria-selected="false">
                                            <i class="ti-layout-grid4-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>


                        
                        <div class="shop-product-content tab-content mt-3">
                            <div id="grid-sidebar3" class="pl-4 tab-pane fade active show">
                                <div class="row">

                                    {{-- Product Col Start --}}
                                    @foreach ($products as $product)
                                    <div class="col-xl-3 col-lg-2 side-product-border" style="position: relative;" >
                                        <div class=" product-wrapper right-bottom-shadow mb-3 " style="height: 100%; position: relative;">
                                            <div class="product-img">
                                                <a href="{{route('product-index', $product->id)}}" target="_blank">
                                                    <div class="hoverChangeImgContainer">
                                                        <div class="sm-prod-img-container prod-back-div childImage transition-low"
                                                            style="background-image: url('{{ asset('storage/images/products/'.$product->images[0]->image) }}');">
                                                        </div>
                                                        @php
                                                            $image = $product->images[0]->image;
                                                            if(isset($product->images[1])) {
                                                                $image = $product->images[1]->image;
                                                            }
                                                        @endphp
                                                        <div class="sm-prod-img-container prod-back-div childImage transition-low"
                                                            style="background-image: url('{{ asset('storage/images/products/'.$image) }}');">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            {{-- Product Buttons --}}
                                            <div class="w-100 text-center pt-3" >
                                                <div class="product-action-electro">
                                                    <a class="animate-top cursor-pointer cart-btn-b cart-btn-b1  " title="Add To Cart" wire:click="$emit('ToggleCart', 1)">
                                                        <i class="pe-7s-cart"></i>
                                                    </a>    
                                                    <a class="animate-left cursor-pointer wishlist-btn-b wishlist-btn-b1 " title="Wishlist" wire:click="$emit('ToggleWishlist', 1)">
                                                        <i class="pe-7s-like"></i>
                                                    </a>
                                                    <a class="animate-right cursor-pointer compare-btn-b compare-btn-b1 " title="Compare" wire:click="$emit('ToggleCompare', 1)">
                                                        <i class="pe-7s-repeat"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="w-100 mt-2 text-center">
                                                <div class="product-rating-4">
                                                    <i class="icofont icofont-star yellow"></i>
                                                    <i class="icofont icofont-star yellow"></i>
                                                    <i class="icofont icofont-star yellow"></i>
                                                    <i class="icofont icofont-star yellow"></i>
                                                    <i class="icofont icofont-star"></i>
                                                </div>
                                                
                                            </div>
                                            <div style="height: 20px;" class="text-center">
                                                @if ($product->product_stock < 1)
                                                    <span class="text-danger font-weight-bold" style="font-size: 15px;">
                                                        Out Of Stock
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="product-content text-center  pt-0 ">
                                                <a href="{{route('product-index', $product->id)}}">
                                                    <span class="line-limit-3" style="font-size: 15px; font-weight: 600; height: 72px;">
                                                        <span >
                                                            {{$product->product_name}} 
                                                        </span>
                                                    </span>
                                                </a>
                                                <span><font class="rupees">₹</font> 
                                                    {{ moneyFormatIndia($product->product_price) }}
                                                    <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{ round((($product->product_mrp - $product->product_price) / $product->product_mrp)*100) }}% off</b>
                                                </span>
                                               

                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- Product Col End --}}
        
                                </div>
                            </div>
                        </div>

                    </div>
                
                    <div>
                        <div class="pt-3 pb-3">
                            {{ $products->links('livewire::bootstrap') }}
                        </div>
                    </div>
                
            </div>

        </div>
        </div>
    </div>
</div>

