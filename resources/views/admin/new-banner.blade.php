@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Create New Banner')

@section('css-js')

@endsection


@section('content')
<div class="container-fluid">

<h3>Create New Banner</h3>

@livewire('admin.ui.create-banner')

</div>
@endsection


