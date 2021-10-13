@extends('layouts.panel')

@section('nav-admin-user-management', 'active')
@section('title','Admin User Management')

@section('css-js')
<style>
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }
    table.table tr th:last-child {
        width: 100px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }
    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }
    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }
    table.table td a:hover {
        color: #2196F3;
    }
    table.table td a.settings {
        color: #2196F3;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }
    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }
    .text-success {
        color: #10c469;
    }
    .text-info {
        color: #62c9e8;
    }
    .text-warning {
        color: #FFC107;
    }
    .text-danger {
        color: #ff5b5b;
    }
    </style>
@endsection


@section('content')

<div class="container-fluid">




{{-- Modals Start --}}


  @foreach ($AdminUsers as $AdminUser)
      

  <div class="modal fade" id="UserDeleteConfirmationModal-{{$AdminUser->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
            <a type="button" class="btn btn-danger" href="{{url('/admin/user-management/id/'.$AdminUser->id.'/delete')}}">Remove</a>
        </div>
      </div>
    </div>
  </div>
  @endforeach







  <div class="modal fade" id="CreateNewAdminUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><strong>Add New Admin User</strong> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form method="post" id="UserSearchForm">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Registered Email ID">
                  <small class="text-muted">Search the user by typing the user's registered email.</small>
                </div>
                <button type="submit" class="btn btn-primary float-right">Search User</button>
            </form>



            <form id="CreateAdminUserForm" action="{{ route('admin-user-create-submit') }}" method="POST" class="d-none">
                @csrf
                <input type="text" id="user_id_form_input" name="user_id" value="">
            </form>
            
            <button type="submit" class="btn btn-success d-none" id="CreateAdminUserFormSubmitBtn" form="CreateAdminUserForm">Give this user Admin access &nbsp;<i id="CreateAdminFormSpinner" class="fa fa-spinner fa-spin d-none"></i></button>
            
<br><br><br>

            <div id="UserDetailsDiv"></div>
            <div id="CreateUserFormDiv"></div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


{{-- Modals End --}}


















<h3>Admin User Management</h3>








{{-- Alerts Start --}}

@if(Session::has('AdminUserAdded'))
    <div class="alert alert-success" id="admin_user_created_alert" role="alert">
        Admin user created successfully. <strong>{{ session('AdminUserAdded') }}</strong>
    </div>
@endif

@if(Session::has('EditSuccess'))
    <div class="alert alert-success" id="admin_user_created_alert" role="alert">
        User edited succesfully. <strong>{{ session('EditSuccess') }}</strong>
    </div>
@endif

@if(Session::has('MasterAdminRemove'))
<div class="alert alert-danger" role="alert">
    You cannot edit any user with <strong>Master Admin</strong> role. 
</div>
@endif

@if(Session::has('SelfEdit'))
<div class="alert alert-danger" role="alert">
    You cannot edit yourself. <strong>{{ session('SelfEdit') }}</strong>
</div>
@endif

@if(Session::has('self_remove'))
<div class="alert alert-danger" role="alert">
    You cannot remove yourself. <strong>{{ session('self_remove') }}</strong>
</div>
@endif

@if(Session::has('master_admin_remove'))
<div class="alert alert-danger" role="alert">
    You cannot remove any user with Master Admin role. <strong>{{ session('master_admin_remove') }}</strong>
</div>
@endif

@if(Session::has('admin_removed'))
<div class="alert alert-success" role="alert">
    Admin removed successfully with email <strong>{{ session('admin_removed') }}</strong>
</div>
@endif

{{-- Alerts End --}}



<div class="row"><div class="col">
<button class="btn btn-primary float-right d-block mb-3" data-toggle="modal" data-target="#CreateNewAdminUserModal">Create New Admin User</button>
</div></div>



<!--user Table Start-->
<table id="userTable" class="table table-striped table-bordered table-fluid d-none">
    <thead class="bg-primary text-white">
    <tr>
        <th>Name</th>
        <th>Email ID</th>
        <th>Date Created</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($AdminUsers as $AdminUser)
        <tr>
            <td><a href="#"><img width="25px" height="25px" class="avatar" style="border-radius: 50%" src="{{ profilePicture($AdminUser->dp) }}"> {{ $AdminUser->name }}</a></td>
            <td><a href="#">{{ $AdminUser->email }}</a></td>
            <td>{{ $AdminUser->created_at }}</td>
            @if ($AdminUser->status == 'active')<td><span class="status text-success">&bull;</span>Active</td>@elseif($AdminUser->status == 'suspended')<td><span class="status text-success">&bull;</span>Suspended</td>@else<td><span class="status">&bull;</span>Error</td>@endif
            <td>
                <a href="{{ url('admin/user-management/id/'.$AdminUser->id.'/edit')}}" class="setting" title="Edit" ><i class="fa fa-cog"></i> </a>
                <a href="" class="delete" data-toggle="modal" data-target="#UserDeleteConfirmationModal-{{$AdminUser->id}}" title="Remove User"><i class="fa fa-times"></i></a>
            </td>  
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Email ID</th>
        <th>Date Created</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>

<!--user Table End-->






</div> <!--Container-Fluid End-->

@endsection



@section('bottom-js')
<script>
    $(document).ready(function() {
        $('#userTable').removeClass('d-none')
        $('#userTable').DataTable();
    } );
</script>

<script>
    $('#UserSearchForm').submit(function (e) {
        
        e.preventDefault()
        var _token  = $('input[name="_token"]').val()
        var email   = $('input[name="email"]').val()

        $.ajax({
            url: "{{route('admin-user-search-submit')}}",
            method: "POST",
            data: {
                _token  :_token,
                email   :email,
            },
            success: function(data) {
                if (data.status == 200) {
                    console.log(data)

            var user_details_table = `
            <table style="width: 100%;">
                <tr>
                    <td>Name:</td>
                    <td><strong>${data.name}</strong></td>
                </tr>
                <tr>
                    <td>Email ID:</td>
                    <td><strong>${data.email}</strong></td>
                </tr>
                <tr>
                    <td>Mobile Number:</td>
                    <td><strong>${data.mobile}</strong></td>
                </tr>
                <tr>
                    <td>Created At:</td>  
                    <td><strong>${data.created_at}</strong></td>                      
                </tr>
                <tr>
                    <td>Updated At:</td>
                    <td><strong>${data.updated_at}</strong></td>
                </tr>
            </table> `

            
            $('#user_id_form_input').val(data.user_id)

            $('#CreateUserFormDiv').fadeIn()
            $('#CreateUserFormDiv').html(user_details_table)
            $('#CreateAdminUserFormSubmitBtn').removeClass('d-none')

                    
                }else {
                    $('#CreateUserFormDiv').fadeIn()
                    $('#CreateUserFormDiv').html(data)
                }
            },
        })
    })
</script>


@endsection