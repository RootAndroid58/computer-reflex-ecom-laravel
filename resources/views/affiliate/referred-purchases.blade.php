@extends('layouts.affiliate-menu-layout')

@section('title', 'Referred Purchases')

@section('referred-purchases-nav', 'account-menu-item-active')

@section('right-col-menu')
    
<div class="right-account-container account-details-container"style="padding: 24px 24px;">
     
    <div class="container-fluid">
        <h5 class="mb-3" style="font-weight: 600;">Purchases Made Via Your Affiliate</h5>
    </div>
    
<div class="container-fluid">
<!--Products Table Start-->
<table id="ReferredPurchasesTable" class="table table-striped table-bordered table-fluid">
    <thead class="bg-secondary   text-white">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 20%">Product Purchased</th>
        <th style="width: 10%">Price</th>
        <th style="width: 15%">Commision</th>
        <th style="width: 15%">Purchase Date</th>
        <th style="width: 15%">Status</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 20%">Product Purchased</th>
        <th style="width: 10%">Price</th>
        <th style="width: 15%">Commision</th>
        <th style="width: 15%">Purchase Date</th>
        <th style="width: 15%">Status</th>
    </tr>
    </tfoot>
</table>
    
</div>

</div>

@endsection
    