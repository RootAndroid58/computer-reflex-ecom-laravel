@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Create New Banner')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid"><div id="container">

<h3>Create New Banner</h3>

    @if (Session::has('BannerCreatedSuccess'))
        <div class="alert alert-success" role="alert">
            New banner created successfully! Banner Name: "<strong>{{Session('BannerCreatedSuccess')}}</strong>"
        </div>
    @endif


<form action="{{route('admin-new-banner-submit')}}" method="POST" enctype="multipart/form-data" style="max-width: 650px; margin-left: auto; margin-right: auto;">

    @csrf
    <div>
        <label>Banner Type<font color='red'>*</font></label>
    </div>
    
    <div class="form-check form-check-inline">
        <input class="form-check-input cursor-pointer" type="radio" name="inlineRadioOptions" id="imageOnly" value="option1" onclick="TypeSwitch()">
        <label class="form-check-label cursor-pointer" for="imageOnly">Image Only</label>
    </div>
    <div class="form-check form-check-inline mb-3">
        <input class="form-check-input cursor-pointer" type="radio" name="inlineRadioOptions" id="imageText" value="option2" onclick="TypeSwitch()">
        <label class="form-check-label cursor-pointer" for="imageText">Image & Text</label>
    </div>  

    <div id="div-field">

    </div>
</form>
      
    <div class=" d-none" id="imageOnlyFields">
        <div class="form-group">
            <label>Banner Name <font color='red'>*</font></label>
            <input type="text" name="banner_name" class="form-control @error('banner_name') is-invalid @enderror" placeholder="Banner Name" value="{{old('banner_name')}}">
            @error('banner_name')
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label>Banner Button Link <font color='red'>*</font></label>
            <input type="text" name="banner_btn_link" class="form-control @error('banner_btn_link') is-invalid @enderror" placeholder="Banner Button Text" value="{{old('banner_btn_link')}}">
            @error('banner_btn_link')
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>
        <div class="form-group">
            <label >Banner Image <font color='red'>*</font></label>
            <input type="file" name="banner_img" class="form-control-file" >
        </div>
    
          <button type="submit" class="btn btn-success">Create Banner</button>
    </div>



    

    <div id="imageTextFields" class=" d-none">
        <div class="form-group">
            <label>Banner Name <font color='red'>*</font></label>
            <input type="text" name="banner_name" class="form-control @error('banner_name') is-invalid @enderror" placeholder="Banner Name" value="{{old('banner_name')}}">
            @error('banner_name')
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>
    
        <div class="form-group">
            <label>Banner Header <font color='red'>*</font></label>
            <input type="text" name="banner_header" class="form-control @error('banner_header') is-invalid @enderror" placeholder="Banner Header" value="{{old('banner_header')}}">
            @error('banner_header')
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>
    
        <div class="form-group">
            <label>Banner Header Line 2 <font color='red'>*</font></label>
            <input type="text" name="banner_header_2" class="form-control @error('banner_header_2') is-invalid @enderror" placeholder="Banner Header Line 2" value="{{old('banner_header')}}">
            @error('banner_header_2')
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>
    
        <div class="form-group">
            <label>Banner Caption <font color='red'>*</font></label>
            <input type="text" name="banner_caption" class="form-control @error('banner_caption') is-invalid @enderror" placeholder="Banner Caption" value="{{old('banner_caption')}}">
            @error('banner_caption')
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>
    
        <div class="form-row">
            <div class="form-group col">
                <label>Banner Button Text <font color='red'>*</font></label>
                <input type="text" name="banner_btn_txt" class="form-control @error('banner_btn_txt') is-invalid @enderror" placeholder="Banner Button Text" value="{{old('banner_btn_txt')}}">
                @error('banner_btn_txt')
                    <span class="invalid-feedback">{{ $message }}</span> 
                @enderror
            </div>
            <div class="form-group col">
                <label>Banner Button Link <font color='red'>*</font></label>
                <input type="text" name="banner_btn_link" class="form-control @error('banner_btn_link') is-invalid @enderror" placeholder="Banner Button Text" value="{{old('banner_btn_link')}}">
                @error('banner_btn_link')
                    <span class="invalid-feedback">{{ $message }}</span> 
                @enderror
            </div>
        </div>
        
    
        <div class="form-group">
            <label >Banner Image <font color='red'>*</font></label>
            <input type="file" name="banner_img" class="form-control-file" >
        </div>
    
          <button type="submit" class="btn btn-success">Create Banner</button>
    </div>





</div></div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')
<script>
    function TypeSwitch() {
        if ($('#imageOnly').is(':checked')) {
            $('#div-field').html($('#imageOnlyFields').html());
        }
        if ($('#imageText').is(':checked')) {
            $('#div-field').html($('#imageTextFields').html());
        }
    }
    
</script>
@endsection