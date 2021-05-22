@extends('layouts.panel')

@section('title', 'Manage Offers & Promotionals')

@section('nav-manage-offers-promotionals', 'active')

@section('content')
<div class="container-fluid">
    <h3>Manage Vouchers</h3>
    <br>

    <div class="w-100 text-right mb-3">
        <a class="btn btn-dark" href="{{ route('admin-create-voucher') }}">Create Voucher</a>
    </div>




    <table id="AdminVouchersTable" class="table table-striped table-bordered table-fluid">
        <thead class="bg-dark text-white">
        <tr>
            <th style="width: 5%">#</th>
            <th >Voucher Code</th>
            <th >Products</th>
            <th >Status</th>
            <th >Exp. Date</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
    
        </tbody>
        <tfoot>
        <tr>
            <th style="width: 5%">#</th>
            <th >Voucher Code</th>
            <th >Products</th>
            <th >Status</th>
            <th >Exp. Date</th>
            <th >Action</th>
        </tr>
        </tfoot>
    </table>


</div>

@endsection

@section('bottom-js')
<script>
    $('#AdminVouchersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminVouchersTable')}}"
        },
        columns: [
            {
                data: 'voucher_id',
                name: 'voucher_id',
            },
            {
                data: 'voucher_code',
                name: 'voucher_code',
            },
            {
                data: 'products',
                name: 'products',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'exp_date',
                name: 'exp_date',
            },
            {
                data: 'action',
                name: 'action',
            },
        ]
    });
</script>
@endsection