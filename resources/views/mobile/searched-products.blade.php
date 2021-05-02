@extends('layouts.mobile-common')

@section('title', 'Search: '.Request()->search)

@section('modals')

<!-- Modal -->
<div class="modal fade" id="SearchSortModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                    <div class="form-group w-100">
                      <label for="" style="font-weight: 600;">Sort By : </label>
                      <select class="form-control" name="" id="sort_by_select">
                        <option value="Default">Default</option>
                        <option @if (Request()->sort_by == 'A to Z') selected @endif value="A to Z">A to Z</option>
                        <option @if (Request()->sort_by == 'Z to A') selected @endif value="Z to A">Z to A</option>
                        <option @if (Request()->sort_by == 'Price Low to High') selected @endif value="Price Low to High">Price Low to High</option>
                        <option @if (Request()->sort_by == 'Price High to Low') selected @endif value="Price High to Low">Price High to Low</option>
                      </select>
                    </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="SearchFilterModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" style="padding-bottom: 30px;">
                    <form method="GET" action="@if(isset($slug)){{route('show-catalog', $slug)}}@else{{ route('search')}}@endif" id="filter_form">
                        <input type="hidden" name="sort_by" value="">
                        <input type="hidden" name="search" value="{{ request()->search }}">
                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title">Filter By Category</h3>
                            <div class="sidebar-categories">
                            <div class="form-group">
                                <select class="" name="category" id="" style="height: 30px; cursor: pointer;" >
                                <option value="all">All</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->category}}" @if($category->category == request()->category) selected @endif>{{$category->category}}</option>
                                @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                
                        <div class="sidebar-widget mb-40">
                            <h3 class="sidebar-title">Filter by Price</h3>
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <div class="_2b0bUo">
                                        <div class="_1YAKP4">
                                            <input type="number" name="min_price" class="_2YxCDZ" value="{{ request()->min_price ?? '' }}">
                                            <small id="helpId" class="form-text text-muted">Min Price</small>
                                        </div>

                                            <div class="_3zohzR">To</div>
                                        
                                            <div class="_3uDYxP">
                                                <input type="number" name="max_price" class="_2YxCDZ" value="{{ request()->max_price ?? '' }}">
                                                <small id="helpId" class="form-text text-muted">Max Price</small>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget mb-40">
                            <h3 class="sidebar-title">Availability</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="stock" value="checked" id="flexCheckDefault" @if(request()->stock == 'checked') checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Show Out Of Stock Items
                                    </label>
                                </div>
                        </div>

                    
                        <div class="sidebar-widget mb-40">
                            <h3 class="sidebar-title">Specifications</h3>
                                
                                @foreach ($SpecsFilter as $Group => $SpecsGroup)
                                <div class="collapse-item">
                                    @php
                                    if (isset(Request()->specs[$Group])) {
                                        $checked = Request()->specs[$Group];
                                    } else {
                                        $checked = null;
                                    }
                                    @endphp
                                    <div class="collapse-btn @if($checked != null) on @endif" style="padding: 7px 10px; transition: all 200ms; background-color: rgba(212, 212, 212, 0.781);">
                                        <span style="font-weight: 600">{{ $Group }}</span>
                                    </div>
                                    <div class="collapse-content" style="@if($checked != null) max-height: fit-content; transition: all 200ms; @endif ">
                                       
                                        @foreach ($SpecsGroup as $Specs)
                                            <div style="padding-top: 6px; padding-bottom: 6px;">
                                                <div class="form-check">
                                                    <input class="form-check-input cursor-pointer" name="specs[{{$Group}}]" value="{{$Specs->specification_value}}" type="checkbox" id="{{$Specs->specification_value.$Specs->id}}" @if ($checked == $Specs->specification_value) checked @endif>
                                                    <label class="form-check-label cursor-pointer line-limit-2" for="{{$Specs->specification_value.$Specs->id}}">{{$Specs->specification_value}}</label>
                                                </div>
                                            </div>
                                            <div class="account-menu-break"></div>  
                                        @endforeach
                                    </div>
                                </div>
                                
                                @endforeach
                             
                        </div>
                        </form>
                </div>

                
                        <div class="text-right w-100 bg-light" style="position: fixed; bottom: 0; left: 0; right: 0;">
                            <button data-dismiss="modal" class="btn btn-secondary float-left" style="width: 50%">Close</button>
                            <button onclick="submitFilterForm()" class="btn btn-primary float-right" style="width: 50%">Apply</button>
                        </div>
                 
                    
            

               
            </div>
        </div>
    </div>
@endsection

@section('header-extra')
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-6 text-center" style="border-right: white solid 2px;">
                <div style="padding: 10px 0; font-weight: 600;" data-target="#SearchSortModal" data-toggle="modal">
                    <span>
                        <i class="fad fa-sort-amount-down-alt"></i> Sort By
                    </span>
                </div>
            </div>
            <div class="col-6 text-center" style="border-left: white solid 2px;">
                <div style="padding: 10px 0; font-weight: 600;" data-target="#SearchFilterModal" data-toggle="modal">
                    <span>  
                        <i class="far fa-filter"></i> Filter
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="container-fluid">

    <div id="RowDiv">
        <div id="grid-sidebar3" class="tab-pane fade active show">
            
                <p style="font-size: 16px; margin-top: 15px;"><span style="font-weight: 600;">{{$ProductsCount}}</span> Products Found.</p>
        
        
            <div class="row">
                {{-- Product Col Start --}}
                @foreach ($products as $product)
                <div class="col-md-4 col-xl-3 col-6" style="border: 1px solid #f0f0f0">             
                    <div class="product-wrapper mb-30">
                        <div class="product-img">
                            <a href="{{route('product-index', $product->id)}}" target="_blank">
                                <div class="sm-prod-img-container prod-back-div" style="background-image: url('{{ asset('storage/images/products/'.$product->images[0]->image) }}');"></div>
                            </a>
                            <div class="product-action">
                                <a class="animate-left cursor-pointer" onclick="ToggleWishlist({{$product->id}})" title="Wishlist"><i class="pe-7s-like"></i></a>
                                <a class="animate-top cursor-pointer" onclick="ToogleCart({{$product->id}})" title="Add To Cart"><i class="pe-7s-cart"></i></a>
                                <a class="animate-right cursor-pointer" onclick="ToggleCompare({{$product->id}})" title="Compare"><i class="pe-7s-repeat"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a class="line-limit-3" href="{{route('product-index', $product->id)}}"> {{$product->product_name}} </a></h4>
                            <span><font class="rupees">₹</font> 
                                {{ moneyFormatIndia($product->product_price) }}
                                <b style="font-size: 17px; color: #388e3c; font-weight: 500;">{{((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100}}% off</b>
                            </span>
                            @if ($product->product_stock <= 0)
                                <br>
                                <span class="text-danger">Out Of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- Product Col End --}}

            </div>

            <div class="mt-3 mb-3">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>

</div>



@endsection

@section('bottom-js')
<script>
    var acc = document.getElementsByClassName("collapse-btn");
    for (let i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("on");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      });
    }
  
  </script> 
  <script>
    function submitFilterForm() {
        $('#filter_form').submit();
        $('#SearchFilterModal').modal('toggle')
    }
</script>
@endsection
