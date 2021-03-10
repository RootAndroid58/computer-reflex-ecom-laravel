@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Manage UI')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

    <div id="container">

<h3>UI Management</h3>

<div class="row">
    <div class="col-md-3">
        <a class="btn btn-lg btn-block btn-primary" href="{{route('admin-manage-banners')}}">Manage Banners</a>
    </div>
    <div class="col-md-3">
        <a class="btn btn-lg btn-block btn-primary" href="{{route('admin-manage-home-carousel-sliders')}}">Home Products Carousels</a>
    </div>
</div>




</div></div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')

@endsection