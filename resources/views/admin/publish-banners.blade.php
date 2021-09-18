@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Publish Banners')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

<h3>Publish Banners</h3>

@if (Session::has('ChangesPublished'))
<div class="alert alert-success" role="alert">Changes successfully published!</div>
@endif
<form action="{{ route('admin-publish-banners-submit') }}" method="post" style="max-width: 650px; margin-left: auto; margin-right: auto;">
    @csrf
<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label >Banner Position: <strong>1</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_1">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 1) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>2</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_2">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 2) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>3</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_3">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 3) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>4</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_4">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 4) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>5</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_5">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 5) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
    </div>
    

    <div class="col-md-6">

        <div class="form-group">
            <label >Banner Position: <strong>6</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_6">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 6) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>7</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_7">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 7) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>8</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_8">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 8) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>9</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_9">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 9) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="form-group">
            <label >Banner Position: <strong>10</strong></label>
            <select class="custom-select my-1 mr-sm-2" name="banner_10">
                <option value="">No Banner</option>
                @foreach ($banners as $banner)
                
                <option value="{{ $banner->id }}" @if ($banner->position == 10) selected @endif>{{ $banner->banner_name }}</option>
                @endforeach
              </select>
        </div>

    </div>

</div>

<i class="fa fa-lightbulb-o" style="color: rgb(255, 187, 0);"></i> Simply choose "No Banner" if you don't want any banner in that position.

<div class="row float-right">
    <button type="submit" class="btn btn-success btn-sm">Publish Changes <i class="fa fa-check" aria-hidden="true"></i></button>
</div>

</form>

<br><br>
@if($errors->any())
        <div class="alert alert-danger " role="alert">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </div>
@endif

</div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')

@endsection