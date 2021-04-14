@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Publish Product')

@section('css-js')
<style>
    .tagit{
        height: 40vh;
        border-radius: 10px;
        border-color: black;
    }
</style>
@endsection


@section('content')

<div class="container-fluid">

<h3>Add Tags & Images</h3>


<div class="container">
    <h5><strong>{{ $product->product_name }}</strong></h5>
       <h6>Tags help improving prduct discovery on search</h6> 
        <p>Enter your tags in the below field, and press <strong>Space</strong> after typing.</p>
       <br />
    <br />


        <form action="{{ route('admin-publish-product-tag-submit') }}" method="POST" id="Form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <ul id="myTags"></ul>

            

            @error('tags')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror



            <div class="form-group  mb-3 ">
              <input type="file" class="form-control-file" name="images[]" multiple>
              <small id="fileHelpId" class="form-text text-muted">Upload Product Images</small>
            </div>

            @error('images')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

<div class="row">
    <div class="form-group col-6">
        <label for="product_stock">Product Stock</label>
        <input type="number" class="form-control" name="product_stock" id="product_stock" placeholder="Number of stock. (e.g. 58)" required>
          <small class="form-text text-muted">Enter <b>0</b> for No Stock</small>
    </div>
    <div class="form-group col-6">
      <label for="product_status">Product Status</label>
      <select class="form-control" name="product_status" id="product_status" required>
        <option disabled selected>Please select...</option>
        <option value="0">Inactive</option>
        <option value="1">Active</option>
      </select>
    </div>
</div>



                @error('product_stock')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

            <button class="btn btn-success float-right bt-lg" id="btn">&nbsp;&nbsp; Next <i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;</button>
        </form>

    
  </div>
</div> <!--Container-Fluid End-->

<script>

$('#btn').click(function () {
    $('Form').submit()
})

// $('#Form').submit(function (e) {
//     e.preventDefault();
// })

    $(document).ready(function() {
            $("#myTags").tagit({
                fieldName: "tags[]",
                allowSpaces: true,
                autocomplete: false,
            });
            
        });
    
    </script>
@endsection



@section('bottom-js')


@endsection
