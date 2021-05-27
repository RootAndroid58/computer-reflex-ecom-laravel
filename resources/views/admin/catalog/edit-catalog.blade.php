@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Edit Catalog')



@section('content')


<div class="container-fluid">

<h3>Create New Catalog</h3>
<br>
    @if (Session::has('CatalogEdited'))
    <div class="alert alert-success" role="alert">
        <strong>Catalog edited successfully.</strong>
    </div>
    @endif
   

    <div class="w-100" >
        <form action="{{ route('admin-edit-catalog-submit') }}" method="post"> @csrf
            <input type="hidden" name="catalog_id" value="{{ $catalog->id }}">

            <div class="form-group">
              <label for="slug">Slug <font color="red">*</font></label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">{{ url('') }}/catalog/</span>
                    </div>
                    <input value="{{ old('slug') ?? $catalog->slug }}" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" aria-describedby="helpId" placeholder="">
                    @error('slug')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                    <small id="helpId" class="form-text text-muted">Must be unique. Spaces wil be replaced with "-", and text wil transform lowercase.</small>
                </div>

                <div class="w-100 mb-3 text-right">
                        <button type="submit" class="btn btn-success">Edit Catalog</button>
                </div>

              <p class="mt-3">Products List (Add Products From Below Table)</p>
                @error('product_ids')
                    <div class="text-danger">{{$message}}</div>
                @enderror


           
                        
        <!--Products Table Start-->
        <table id="AdminProductsTable" class="table table-striped table-bordered w-100">
            <thead class="bg-primary text-white">
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

              <div class="products-list-container mt-4" >
                  @foreach ($catalog->CatalogProducts as $CatalogProduct)
                  <div id="SectionProduct{{ $CatalogProduct->product->id }}">        
                    <input type="hidden" name="product_ids[]" value="{{ $CatalogProduct->product->id }}">
                    <div class="row">
                        <div class="col-1">
                            <img width="100%" src="{{ asset('storage/images/products/'.$CatalogProduct->product->images[0]->image) }}" alt="" srcset="">
                        </div>
                        <div class="col-9">
                            {{ $CatalogProduct->product->product_name }}
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger" onclick="RemoveFromSlider({{ $CatalogProduct->product->id }})">Remove</button>
                        </div>
                    </div>
                </div>
                  @endforeach
                
              </div>

        </form>
    </div>

</div> <!--Container-Fluid End-->
@endsection

@section('bottom-js')
<script>
    function AddToSlider(product_id, image, product_name) {

        if($("#SectionProduct"+product_id).length){
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Product Already Exists.", {
                type: "danger",
                offset: {from:"bottom", amount: 50},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else {
        $('.products-list-container').append(
        `
        <div id="SectionProduct`+product_id+`">        
        <input type="hidden" name="product_ids[]" value="`+product_id+`">
        <div class="row">
            <div class="col-1">
                <img width="100%" src="`+image+`" alt="" srcset="">
            </div>
            <div class="col-9">
                `+product_name+`
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-danger" onclick="RemoveFromSlider(`+product_id+`)">Remove</button>
            </div>
        </div>
        </div>
        `);
        }
    }

    function RemoveFromSlider(product_id) {
        $('#SectionProduct'+product_id).remove();
    }
</script>

<script>

    $('#AdminProductsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminSliderProductsTable')}}"
        },
        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'product_name',
                name: 'product_name',
            },
            {
                data: 'product_brand',
                name: 'product_brand',
            },
            {
                data: 'product_mrp_custom',
                name: 'product_mrp_custom',
            },
            {
                data: 'product_price_custom',
                name: 'product_price_custom',
            },
            {
                data: 'stock',
                name: 'stock',
            },
            {
                data: 'product_status',
                name: 'product_status',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
            },
        ]



    });
</script>
@endsection