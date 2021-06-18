@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Manage Products')

@section('css-js')

@endsection


@section('content')

<div class="container-fluid">

    
@if(Session::has('ProductRemoved'))
    <div class="alert alert-success" id="admin_user_created_alert" role="alert">
        Product removed sucessfully.
    </div>
@endif

@if(Session::has('product_published'))
    <div class="alert alert-success" id="admin_user_created_alert" role="alert">
        Product published sucessfully. <strong>{{ session('listing_created') }}</strong>
    </div>
@endif

@if(Session::has('listing_created'))
    <div class="alert alert-success" id="admin_user_created_alert" role="alert">
        Product listing created, Now you just have to publish the product. <strong>{{ session('listing_created') }}</strong>
    </div>
@endif
        


    @foreach ($products as $product)
    <!-- Modal -->
    <div class="modal fade" id="RemoveProductModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Product Remove Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure removing this product from listing? <br><br><b>{{$product->product_name}}</b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{ route('remove-product',$product->id) }}" class="btn btn-danger">Remove Product</a>
          </div>
        </div>
      </div>
    </div>
  @endforeach




    <div class="row">
        <div class="col-md-4">
            <a href="{{route('admin-new-product-listing')}}" class="btn btn-block btn-lg btn-secondary">New Product Listing</a>
        </div>
        <div class="col-md-4">
            <a href="{{route('admin-product-publish')}}" class="btn btn-block btn-lg btn-secondary">Publish Products</a>
        </div>

    </div>

<br><br>




    
<!--Products Table Start-->
<table id="AdminProductsTable" class="table table-striped table-bordered table-fluid w-100">
    <thead class="bg-secondary text-white">
    <tr>
        <th style="width: 3%">#</th>
        <th style="width: 20%">Product Name</th>
        <th style="width: 10%">Brand</th>
        <th style="width: 10%">MRP</th>
        <th style="width: 10%">Price</th>
        <th style="width: 10%">Stock</th>
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

    $('#AdminProductsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminProductsTable')}}"
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