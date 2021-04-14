@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Publish Products')

@section('css-js')

@endsection


@section('content')
<div class="container-fluid">


      
<!--Products Table Start-->
<table id="AdminProductsTable" class="table table-striped table-bordered table-fluid">
    <thead class="bg-primary text-white">
    <tr>
        <th style="width: 3%">#</th>
        <th style="width: 20%">Product Name</th>
        <th style="width: 20%">Brand</th>
        <th style="width: 10%">MRP</th>
        <th style="width: 10%">Price</th>
        <th style="width: 10%">Status</th>
        <th style="width: 15%">Action</th>
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
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>




</div> <!--Container-Fluid End-->
@endsection





@section('bottom-js')


<script>

    $('#AdminProductsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminProductsPublishTable')}}"
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
                data: 'product_status_custom',
                name: 'product_status_custom',
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