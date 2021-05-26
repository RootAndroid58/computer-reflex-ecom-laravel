@extends('layouts.panel')

@section('title', 'Edit Voucher')

@section('nav-manage-offers-promotionals', 'active')

@section('content')

<div class="container-fluid">
    <h3>Create Voucher</h3>
    <br>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin-create-voucher-submit') }}" method="post" class="mt-3 mb-3"> @csrf

        <div class="form-group">    
            <label for="section_title">Expiry Date <font class="text-danger">*</font></label>
            <input type="date" min="{{ date('Y-m-d', strtotime(' +1 day')) }}" required value="" class="form-control" name="exp_date">
        </div>

        <div class="w-100 text-right mb-3">
            <button type="submit" class="btn btn-success">Create Voucher</button>
        </div>

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

        <p class="mt-3">Products List (Add Products From Below Table)</p>
        
        <div class="products-list-container"></div>

    </form>

</div>

@endsection

@section('bottom-js')
<script>
    function AddToSlider(product_id, image, product_name, mrp) {
        if($(".SectionProduct"+product_id).length){
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
        <div class="SectionProduct`+product_id+`">        
        <input type="hidden" name="product_ids[]" value="`+product_id+`">
            <div class="row">
                <div class="col-1">
                    <img width="100%" src="`+image+`" alt="" srcset="">
                </div>
                <div class="col-6">
                    `+product_name+`
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Special Price / Unit <font class="text-danger">*</font></label>
                        <input type="number" required
                            class="form-control" name="special_prices[]" aria-describedby="helpId" placeholder="">
                        <small class="form-text text-muted">MRP: <strong>${mrp}</strong></small>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Qty <font class="text-danger">*</font></label>
                        <input type="number" required
                            class="form-control" name="qty[]" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="col-1 justify-content-center align-items-center d-flex">
                    <button type="button" class="btn btn-danger" onclick="RemoveFromSlider(`+product_id+`)">Remove</button>
                </div>
            </div>
            <div class="account-menu-break"></div>
        </div>

        `);

            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Product Added.", {
                type: "success",
                offset: {from:"bottom", amount: 50},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        }
    }

    function RemoveFromSlider(product_id) {
        console.log(product_id);
        $('.SectionProduct'+product_id).remove();
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