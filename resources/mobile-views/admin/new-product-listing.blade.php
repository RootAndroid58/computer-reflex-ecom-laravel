@extends('layouts.panel')

@section('title', 'New Product Listing')

@section('nav-manage-products', 'active')

@section('css-js')

@endsection

@section('content')
<div class="container-fluid">


<h3 class="text-dark ">New Product Listing</h3>


<div class="" style="position:relative;">
<form action="{{route('admin-new-product-listing-submit')}}" method="POST" enctype="multipart/form-data">
 @csrf

    <div style="max-width: 550px; padding: 15px; margin-left: auto; margin-right: auto;" >
            <div class="form-group">
                <label class="text-dark">Product Name</label>
                <input name="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="Name of the product you wanna list." value="{{old('product_name')}}">
                @error('product_name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-dark">Brand Name</label>
                <input name="product_brand" class="form-control @error('product_brand') is-invalid @enderror" placeholder="Name of the brand." value="{{old('product_brand')}}">
                @error('product_brand')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-dark">Category</label>
                <select name="category" class="form-select form-select-lg mb-3 form-control @error('category') is-invalid @enderror" name="category">
                    <option selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
               
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-dark">Product MRP</label>
                        <input name="product_mrp" id="product_mrp" class="form-control @error('product_mrp') is-invalid @enderror" placeholder="&#8377; Product MRP (INR).">
                        @error('product_mrp')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-dark">Selling Price</label>
                        <input name="product_price" id="product_price" class="form-control @error('product_price') is-invalid @enderror" placeholder="&#8377; Selling Price (INR).">
                        <div class="invalid-feedback">Selling price can't be greater than MRP!</div>
                        @error('product_price')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="text-dark">% Discount</label>
                <input id="discount" class="form-control" placeholder="% Discount." readonly>
                <small class="text-muted" id="sHelpText">Discount auto calculated.</small>
                <div class="invalid-feedback">Selling price can't be greater than MRP!</div>
            </div>
        <hr>

            <div class="form-group">
                <label class="text-dark">Description</label>
                <textarea name="product_description" id="description" class="form-control @error('product_description') is-invalid @enderror" placeholder="Product description." rows="7"></textarea>
                @error('product_description')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Create Listing</button>
            </div>

            <br>
            <li>You can also edit these fields later.</li>
            <li>After creating the listing, product will be listed with status <b>Pending</b>, next you have to Publish the product from <b>Publish Products</b> section.</li>

    
        </div>  



</form>
</div>



<br><br>
</div>
@endsection







@section('bottom-js')



<script>
    $(document).ready(function() {

        $('#description').summernote({
        toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear', ]],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['codeview']]
    ],
            minHeight: 220,         // set minimum height of editor
            maxHeight: 500,         // set maximum height of editor
            focus: true,    
        }); 
    });
</script>


<script>
    $(document).ready(function(){
        $(document).on('mouseover mouseout keyup','body *',function() {
        var m = parseInt($('#product_mrp').val()); 
        var s = parseInt($('#product_price').val());
        var perc="";

        if (s>m) {
            $('#discount').val('')
            $('#discount').addClass('is-invalid')
            $('#sHelpText').addClass('d-none')
            $('#product_price').addClass('is-invalid')
        } else {
            $('#discount').removeClass('is-invalid')
            $('#sHelpText').removeClass('d-none')
            $('#product_price').removeClass('is-invalid')
            if(isNaN(m) || isNaN(s)){
                perc="";
            } else { 
            perc = (((m - s)/m)*100).toFixed(0);
           }
           $('#discount').val(perc+'%');
        }
        })
        })
</script>





@endsection