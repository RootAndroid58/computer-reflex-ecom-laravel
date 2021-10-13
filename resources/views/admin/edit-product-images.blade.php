@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Edit Product Images')

@section('content')

<div class="container-fluid">
  @livewire('admin.manage-products.edit-images-component', ['pid' => $pid])




  

        
</div> <!--Container-Fluid End-->
@endsection
