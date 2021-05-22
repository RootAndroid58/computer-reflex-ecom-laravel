@extends('layouts.panel')

@section('title', 'Manage Offers & Promotionals')

@section('nav-manage-offers-promotionals', 'active')

@section('content')
<div class="container-fluid">
    <h3>Manage Offers & Promotionals</h3>
    <br>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin-manage-vouchers') }}" class="btn btn-block btn-lg btn-dark">Vouchers</a>
        </div>
        <div class="col-md-4">
            <a href="https://computerreflex.dev/admin/delivery-confirmation" class="btn btn-block btn-lg btn-dark">Delivery Confirmation</a>
        </div>
        <div class="col-md-4">
            <a href="https://computerreflex.dev/admin/delivery-confirmation" class="btn btn-block btn-lg btn-dark">Cancel Requests</a>
        </div>
    </div>
</div>

@endsection