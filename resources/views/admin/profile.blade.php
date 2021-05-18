@extends('layouts.panel')

@section('nav-profile', 'active')
@section('title','Profile')

@section('css-js')
<link rel="stylesheet" href="{{ asset('css/Bootstrap-Image-Uploader.css')}}">
@endsection


@section('content')


<!-- Modal -->
<div class="modal fade" id="DPupdateModal" tabindex="-1" role="dialog" aria-labelledby="DPupdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 >Change Photo <span class="badge badge-secondary">New</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <!-- Upload image input-->
          <form action="{{ route('dp-update')}}" method="post" id="dpUpdate" name="dpUpdate" enctype="multipart/form-data">
              @csrf
              <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                  <input id="upload" name="dp" type="file" class="form-control border-0">
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
          <button type="button" class="btn btn-primary" onclick="document.dpUpdate.submit();">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal End -->



<div class="container-fluid">




<h3 class="text-dark mb-4">Profile</h3>
<div class="row mb-3">
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{ asset('/storage/images/dp/'.Auth::user()->dp) }}" width="160" height="160">
                <div class="mb-3" data-toggle="modal" data-target="#DPupdateModal"><button class="btn btn-primary btn-sm" type="button">Change Photo</button></div>
                @error('dp')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">User Details</p>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="first_name"><strong>Full Name</strong></label><input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="last_name"><strong>Created At</strong></label><input class="form-control" type="text" value="{{ Auth::user()->created_at }}" disabled></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="username"><strong>Mobile Number</strong></label><input class="form-control" type="text" value="{{ Auth::user()->mobile }}" disabled></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" value="{{ Auth::user()->email }}" disabled></div>
                            </div>
                        </div>
                            
                            <fieldset class="form-group">
                                <div class="row">
                                  <legend class="col-form-label col-2 pt-0"><strong>Permissions</strong></legend>
                                  
                                  <div class="col-10">
                                    @foreach ($permissions as $permission)
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="{{$permission->name}}" id="{{$permission->name}}" disabled>
                                      <label class="form-check-label" for="{{$permission->name}}">
                                        {{$permission->name}}
                                      </label>
                                    </div>
                                    @endforeach
                                  </div>
                                  
                                </div>
                              </fieldset>

                        <div class="form-group text-right"><a class="btn btn-primary btn-sm" href="#">Request Changes</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>











</div>










</div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')
    <script src="{{ asset('/js/Bootstrap-Image-Uploader.js')}}"></script>
@endsection