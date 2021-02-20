@extends('layouts.panel')

@section('nav-manage-orders', 'active')
@section('title','Manage Orders')

@section('css-js')
    <style>
        #AdminOrdersTable td{
            font-weight: 600;
        }
    </style>
@endsection


@section('content')

<div class="container-fluid">

    <h3>All Orders</h3>
    <br>

    <div class="row">
        <div class="col-md-4">
            <a href="{{route('admin-ship-orders')}}" class="btn btn-block btn-lg btn-primary">Ship Orders</a>
        </div>
    </div>

<br><br>


    
<!--Products Table Start-->
<table id="AdminOrdersTable" class="table table-striped table-bordered table-fluid">
    <thead class="bg-primary text-white">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 10%">Order Date</th>
        <th style="width: 10%">Customer Name</th>
        <th style="width: 10%">Reg. Mobile</th>
        <th style="width: 20%">Reg. Email</th>
        <th style="width: 10%">Payment</th>
        <th style="width: 15%">Total Price</th>
        <th style="width: 20%">Status</th>
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

        ]



    });
</script>

@endsection