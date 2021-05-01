@extends('layouts.mobile-common')

@section('title', 'Referred Purchases')

@section('burger-affiliate-purchases-menu', 'account-menu-item-active')

@section('content')
    
<div >
     
    <div class="container-fluid mt-3 mb-3">
        <h5 class="mb-3" style="font-weight: 600;">Purchases Made Via Your Affiliate</h5>
    </div>
    
<div class="container-fluid">
<!--Products Table Start-->
<div class="table-responsive mb-5">
    <table id="ReferredPurchasesTable" class="table table-striped table-bordered table-fluid">
        <thead class="bg-secondary text-white">
        <tr>
            <th style="width: 50%">Product Purchased</th>
            <th style="width: 10%">Price</th>
            <th style="width: 10%">Commision</th>
            <th style="width: 15%">Purchase Date</th>
            <th style="width: 15%">Status</th>
        </tr>
        </thead>
        <tbody>
    
        </tbody>
        <tfoot>
        <tr>
            <th>Product Purchased</th>
            <th>Price</th>
            <th>Commision</th>
            <th>Purchase Date</th>
            <th>Status</th>
        </tr>
        </tfoot>
    </table>
</div>

    
</div>

</div>

@endsection


@section('bottom-js')
    <script>
        
    $('#ReferredPurchasesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.ReferredPurchasesTable')}}"
        },
        columns: [
            {
                data: 'product',
                name: 'product',
            },
            {
                data: 'price',
                name: 'price',
            },
            {
                data: 'comission',
                name: 'comission',
            },
            {
                data: 'purchase_date',
                name: 'purchase_date',
            },
            {
                data: 'status',
                name: 'status',
            },
        ]



    });
    </script>
@endsection