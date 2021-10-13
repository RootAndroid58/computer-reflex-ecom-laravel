@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Manage UI')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

    <div id="container">

<h3>UI Management</h3>

    {{ Breadcrumbs::render(Request::route()->getName()) }}

<div class="row">
    <div class="col-md-3">
        <a class="btn btn-lg btn-block btn-dark" href="{{route('admin-manage-banners')}}">Manage Banners</a>
    </div>
    <div class="col-md-3">
        <a class="btn btn-lg btn-block btn-dark" href="{{route('admin-manage-featured-catalogs')}}">Featured Catalogs</a>
    </div>
</div>




</div></div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')

@endsection