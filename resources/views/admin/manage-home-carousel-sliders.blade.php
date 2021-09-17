@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Home Carousel Sliders')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

<h3>Home Carousel Sliders</h3>

    {{ Breadcrumbs::render(Request::route()->getName()) }}

<div class="w-100 text-right">
    <a href="{{ route('admin-create-home-carousel-slider') }}" class="btn btn-sm btn-dark">Create New Slider</a>
</div>

@livewire('admin.ui.manage-home-carousel')

</div> <!--Container-Fluid End-->


@endsection



@section('bottom-js')
<script>
    function RemoveFromSlider(product_id) {
        $('#SectionProduct'+product_id).remove();
    }
</script>
@endsection