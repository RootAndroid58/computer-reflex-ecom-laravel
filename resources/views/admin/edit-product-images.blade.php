@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Edit Product')

@section('css-js')
<link rel="stylesheet" href="{{ asset('css/Bootstrap-Image-Uploader.css')}}">
<style>
    .tagit{
        height: 40vh;
        border-radius: 10px;
        border-color: black;
    }
</style>
@endsection


@section('content')

<div class="modal fade" id="AddMoreImagesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Add More Images</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">

        <form action="{{ route('edit-add-images-submit') }}" method="post" id="AddImagesForm" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="product_id" value="{{$product->id}}">
          <div class="form-group text-center">
            <input type="file" class="form-control-file" name="images[]" placeholder="" multiple>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="AddImagesForm" class="btn btn-success">Add Images</button>
      </div>
    </div>
  </div>
</div>
 
  <!-- Modal -->
  @foreach ($images as $image)
  <div class="modal fade" id="ImageChange-Modal-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload new image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        <!-- Upload image input-->
        <form action="{{ route('edit-product-images-submit')}}" method="post" id="ImageUpdate" name="ImageUpdate" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <input id="upload" name="new_image" type="file" class="form-control border-0">
                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                <div class="input-group-append">
                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload" aria-hidden="true"></i> <small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                </div>
            </div>
        </form>
            <!-- Uploaded image area-->
            <p class="font-italic text-white text-center">Supported formats: jpg, jpeg, png & max file size of 2 MB</p>
            <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="ImageUpdate" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endforeach
  <!-- Modal -->
  @foreach ($images as $image)
  <div class="modal fade" id="ImageDelete-Modal-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Delete Confirmation</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            <h4>Are you sure, deleteing this image?</h4>
            <br>
            <br>
            <img style="max-width: 375px;" src="{{asset('storage/images/products/'.$image->image)}}" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="{{route('remove-image-submit', $image->id)}}" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>
@endforeach



<div class="container-fluid">

 


  
<h3>Edit Product Images &nbsp;
  <div class="btn-container float-right">
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class="btn btn-dark btn-sm" data-target="#AddMoreImagesModal" data-toggle="modal">Add More Imges</a>
    </div>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class="btn btn-primary btn-sm" href="{{ route('edit-product', $product->id)}}">Edit Product Details</a>
    </div>
  </div>
  


</h3>

@if(Session::has('ImageRemoved'))
<div class="alert alert-success" role="alert">
    <strong>Image Removed.</strong>
</div>
@endif

@if(Session::has('ImagesAdded'))
<div class="alert alert-success" role="alert">
    <strong>Images Added.</strong>
</div>
@endif

@if(Session::has('ImageUpdated'))
<div class="alert alert-success" role="alert">
    <strong>Image Updated.</strong>
</div>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">{{$error}}</div>
    @endforeach
@endif

    <div class="container" style="margin-bottom: 100px;">
        <h5><strong>{{$product->product_name}}</strong></h5>

        @foreach ($images as $image)
        <div class="row p-3">

            <div class="col">
                <img style="max-width: 375px;" src="{{asset('storage/images/products/'.$image->image)}}" alt="">
            </div>

            <div class="col">
                <a href="#" data-toggle="modal" data-target="#ImageChange-Modal-{{$image->id}}" class="btn btn-success pull-left">Edit</a>
                
                <a href="#" data-toggle="modal" data-target="#ImageDelete-Modal-{{$image->id}}" class="btn btn-danger pull-left">Delete</a>
            </div>

        </div>
        @endforeach


    
        
    </div>






        
</div> <!--Container-Fluid End-->

@endsection



@section('bottom-js')
<script src="{{ asset('/js/Bootstrap-Image-Uploader.js')}}"></script>


@endsection