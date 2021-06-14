@extends('layouts.panel')

@section('nav-manage-orders', 'active')
@section('title','Manage Orders')

@section('css-js')

@endsection


@section('content')

<div class="container-fluid">

    <h3>All Orders</h3>
    <br>

    <div class="row">
        <div class="col-md-4">
            <a href="{{route('admin-ship-orders')}}" class="btn btn-block btn-lg btn-dark">Ship Orders</a>
        </div>
        <div class="col-md-4">
            <a href="{{route('admin-delivery-confirmation')}}" class="btn btn-block btn-lg btn-dark">Delivery Confirmation</a>
        </div>
        <div class="col-md-4">
            <a href="{{route('admin-delivery-confirmation')}}" class="btn btn-block btn-lg btn-dark">Cancel Requests</a>
        </div>
    </div>

<br><br>


    
<!--Products Table Start-->
<table id="AdminOrdersTable" class="table table-striped table-bordered table-fluid">
    <thead class="bg-dark text-white">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 10%">Order Date</th>
        <th style="width: 10%">Customer Name</th>
        <th style="width: 10%">Reg. Mobile</th>
        <th style="width: 20%">Reg. Email</th>
        <th style="width: 10%">Payment</th>
        <th style="width: 15%">Total Price</th>
        <th style="width: 20%">Status</th>
        <th style="width: 10%">Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 10%">Order Date</th>
        <th style="width: 10%">Customer Name</th>
        <th style="width: 10%">Reg. Mobile</th>
        <th style="width: 20%">Reg. Email</th>
        <th style="width: 10%">Payment</th>
        <th style="width: 15%">Total Price</th>
        <th style="width: 20%">Status</th>
        <th style="width: 10%">Action</th>
    </tr>
    </tfoot>
</table>







</div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')

<script>

    $('#AdminOrdersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminOrdersTable')}}"
        },
        columns: [
            {
                data: 'order_id',
                name: 'order_id',
            },
            {
                data: 'order_date',
                name: 'order_date',
            },
            {
                data: 'customer_name',
                name: 'customer_name',
            },
            {
                data: 'registered_mobile',
                name: 'registered_mobile',
            },
            {
                data: 'registered_email',
                name: 'registered_email',
            },
            {
                data: 'payment_method',
                name: 'payment_method',
            },
            {
                data: 'price',
                name: 'price',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'action',
                name: 'action',
            },

        ]



    });
</script>

@endsection