@if (isMobile())

    @include('mobile.searched-products')

{{ die }}
@endif



@extends('layouts.common')

@section('title', 'Search: '.Request()->search ?? '')


@section('content')
    
    @livewire('product-search-component')

@endsection
