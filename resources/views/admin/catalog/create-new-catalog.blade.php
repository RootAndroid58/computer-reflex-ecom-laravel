@extends('layouts.panel')


@section('nav-manage-ui', 'active')
@section('title','Home Carousel Sliders')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

<h3>Create New Catalog</h3>


    <div class="container" >
        <form action="{{ route('admin-create-new-catalog-submit') }}" method="post"> @csrf

            <div class="form-group">
              <label for="slug">Slug <font color="red">*</font></label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">{{ url('') }}/catalog/</span>
                    </div>
                    <input value="{{ old('slug') }}" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" aria-describedby="helpId" placeholder="">
                    @error('slug')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                    <small id="helpId" class="form-text text-muted">Must be unique. Spaces wil be replaced with "-", and text wil transform lowercase.</small>
              

              <p class="mt-3">Products List (Add Products From Below Table)</p>
                @error('product_ids')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                
              <div class="products-list-container">

              </div>


            
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-success float-right">Create Catalog</button>
                </div>
            </div>
            
        </form>
        
    </div>


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
            <div class="col-2">
                <img width="100%" src="`+image+`" alt="" srcset="">
            </div>
            <div class="col-8">
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