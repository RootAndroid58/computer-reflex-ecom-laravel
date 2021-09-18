@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Manage Banners')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid"><div id="container">


    <h3>Banners Management</h3>


@livewire('admin.ui.manage-banners')

{{-- Buttons Row End --}}





</div></div> <!--Container-Fluid End-->

@endsection



@section('bottom-js')

@endsection