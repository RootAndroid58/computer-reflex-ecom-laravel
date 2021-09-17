@extends('layouts.panel')

@section('nav-manage-ui', 'active')

@section('title','Create Home Carousel Sliders')


@section('content') 
<div class="container-fluid">


    <h3>
        Create New Home Carousel Slider
    </h3>


    @livewire('admin.ui.create-home-carousel-form')



</div>
@endsection
