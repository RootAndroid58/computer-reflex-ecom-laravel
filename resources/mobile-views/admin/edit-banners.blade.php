@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Edit Banners')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid"><div id="container">

<h3>Edit Banners</h3>

    @foreach ($banners as $banner)
        <div class="container">
            <div class="container-fluid" style="padding: 24px 24px; border-bottom: 1px rgb(190, 190, 190) solid;">
                <div class="row">
                    <div class="col-3">
                        <div class="prod-back-div" style="width: 100%; height: 140px; background-image: url('{{ asset('storage/images/banner/'.$banner->banner_img) }}');"></div>
                    </div>
                    <div class="col-9">
                        <p>
                            <h4>{{ $banner->banner_name }}</h4>
                            <span>
                                Banner Button Link: <a href="{{ $banner->banner_btn_link }}" target="_blank">{{ $banner->banner_btn_link }}</a>
                            </span>
                            <a class="btn btn-dark float-right" href="{{ route('admin-edit-banner-page', $banner->id) }}">Edit</a>
                        </p>

                       
                    </div>
                </div>
            </div>
        </div>
    @endforeach



</div></div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')

@endsection