@extends('layouts.panel')

@section('nav-admin-user-management', 'active')
@section('title','Edit Admin User')

@section('css-js')

@endsection


@section('content')
<div class="container-fluid">


    <div class="modal fade" id="UserDeleteConfirmationModal-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><strong>Admin Remove Confirmation</strong> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure removing this user from Admin access?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger" href="{{url('/admin/user-management/id/'.$user->id.'/delete')}}">Remove</a>
            </div>
          </div>
        </div>
      </div>









<h3 class="text-dark">Edit User</h3>
<h5 class="text-dark text-center"><i style="color: rgb(255, 196, 0)" class="fa fa-circle"></i> You're currently editing <img width="40px" height="40px" style="border-radius: 50%;" src="{{asset("storage/images/dp/$user->dp")}}"> <strong>{{$user->name}}</strong></h5>

<div class="container form-container p-5" style="background-color: rgb(225, 227, 240); box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
<div class="row mt-3 mb-3">
    <div class="col-6 text-center">
        Date Created <strong>{{$user->created_at ?? '--'}}</strong>
    </div>

    <div class="col-6 text-center">
        Last Updated <strong>{{$user->updated_at}}</strong>
    </div>
</div>

<form method="POST" action="{{ route('admin-user-edit-submit') }}">
@csrf
<input type="hidden" name="user_id" id="id" value="{{$user->id}}">
<div class="form-row">
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Full Name</div>
            </div>
            <input type="text" class="form-control @error('name') {{ 'is-invalid' }} @enderror" name="name" value="{{ old('name') ?? $user->name}}" placeholder="Full Name">
        </div>    
    </div>    
</div>


<div class="form-row">
    <div class="form-group col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Email ID</div>
            </div>
            <input type="text" class="form-control @error('email') {{ 'is-invalid' }} @enderror" name="email" value="{{ old('email') ?? $user->email }}" placeholder="Email ID">
        </div>    
    </div>    

    <div class="form-group col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Mobile Number</div>
            </div>
            <input type="text" class="form-control @error('mobile') {{ 'is-invalid' }} @enderror" name="mobile" value="{{ old('mobile') ?? $user->mobile }}" placeholder="Mobile Number">
        </div>   
    </div>
</div>

<h5>Permissions</h5>

@foreach ($permissions as $permission)
<div class="form-check">
    <input class="form-check-input" style="cursor: pointer;" type="checkbox" id="{{ $permission->name }}" name="NewPermissions[]" value="{{ $permission->name }}"   
    @foreach ($userPermissions as $userPermission)
    @if ($userPermission->name == $permission->name)
        checked
    @endif
@endforeach>
    <label class="form-check-label" style="cursor: pointer;" for="{{ $permission->name }}">
        {{ $permission->name }}
    </label>
</div>
@endforeach





<div class="container-fluid text-right">
    <a data-toggle="modal" data-target="#UserDeleteConfirmationModal-{{$user->id}}" class="btn btn-danger">Delete User</a>
    <button type="submit" class="btn btn-success">Save Changes</button>
</div>

</form>
</div>
</div>
@endsection
