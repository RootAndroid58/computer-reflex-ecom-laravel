@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Edit Home Carousel Slider')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

<h3>Edit Home Carousel Slider</h3>

    {{ Breadcrumbs::render(Request::route()->getName(), $HomeSection->id) }}

    @livewire('admin.ui.edit-home-carousel', ['sectionId' => $HomeSection->id])

</div> <!--Container-Fluid End-->


@endsection

