@extends('layouts.panel')

@section('title', 'Ship Orders')

@section('nav-manage-orders', 'active')

@section('css-js')
    
@endsection

@section('content')
<div class="container-fluid">

    <h3>Ship Orders</h3>

<!--Products Table Start-->
<table id="AdminShipOrdersTable" class="table table-striped table-bordered table-fluid">
    <thead class="bg-primary text-white">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 10%">Order Date</th>
        <th style="width: 10%">Customer Name</th>
        <th style="width: 10%">Payment</th>
        <th style="width: 15%">Total Price</th>
        <th style="width: 20%">Status</th>
        <th style="width: 20%">Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 10%">Order Date</th>
        <th style="width: 10%">Customer Name</th>
        <th style="width: 10%">Payment</th>
        <th style="width: 15%">Total Price</th>
        <th style="width: 20%">Status</th>
        <th style="width: 20%">Status</th>
    </tr>
    </tfoot>
</table>


</div>
@endsection


@section('bottom-js')
<script>

    $('#AdminShipOrdersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminShipOrdersTable')}}"
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