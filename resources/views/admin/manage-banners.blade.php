@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Manage Banners')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid"><div id="container">


    <h3>Banners Management</h3>

{{-- Buttons Row Start --}}
<div class="row">

    <div class="col-md-4">
        <a class="btn btn-lg btn-block btn-primary" href="{{route('admin-new-banner')}}">New Banner</a>
    </div>

    <div class="col-md-4">
        <a class="btn btn-lg btn-block btn-primary">Show / Edit Banners</a>
    </div>

    <div class="col-md-4">
        <a class="btn btn-lg btn-block btn-primary" href="{{route('admin-publish-banners')}}">Publish Banners</a>
    </div>

</div>
{{-- Buttons Row End --}}





</div></div> <!--Container-Fluid End-->

@endsection



@section('bottom-js')

@endsection