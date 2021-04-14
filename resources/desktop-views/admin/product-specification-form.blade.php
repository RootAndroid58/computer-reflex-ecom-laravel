@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Publish Product')

@section('css-js')

@endsection


@section('content')

<div class="container-fluid">

<h3>Add Specifications</h3>



<div class="container">
    <h5><strong>{{ $product->product_name }}</strong></h5>
<form action="{{ route('admin-publish-product-specification-submit') }}" method="POST" id="ProductPublishForm">
    @csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <table  class="table table-hover small-text" id="tb2">
        <tr class="tr-header">
            <td class="text-center"><strong>Specification</strong></td>
            <td class="text-center"><strong>Value</strong></td>     
            <td> <a href="javascript:void(0);" class="btn btn-primary btn-sm float-right" id="addMore2" title="Add More Person">Add More &nbsp;<i class="fa fa-plus-square"></i></a></td>     
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <input name="key[]" class="form-control @error('key[]') is-invalid @enderror" placeholder="Specification Name" value="{{old('key[]')}}" required>
                    @error('key[]')<span class="invalid-feedback">{{$message}}</span>@enderror
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input name="value[]" class="form-control @error('value[]') is-invalid @enderror" placeholder="Specification Value"  value="{{old('value[]')}}" required>
                    @error('value[]')<span class="invalid-feedback">{{$message}}</span>@enderror
                </div>
            </td>
            <td>
                <button class="btn btn-danger btn-sm remove">&nbsp;<i class="fa fa-times"></i>&nbsp;</button>
            </td>
            <hr>
        </tr>
    </table>
    <button type="submit" form="ProductPublishForm" class="btn btn-success float-right bt-lg">&nbsp;&nbsp; Next <i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;</button>
</form>  

</div>



</div> <!--Container-Fluid End-->
@endsection



@section('bottom-js')

<script>
    $(function(){
        $('#addMore2').on('click', function() {
                var data = $("#tb2 tr:eq(1)").clone(true).appendTo("#tb2");
                data.find("input").val('');
        });
        $(document).on('click', '.remove', function() {
            var trIndex = $(this).closest("tr").index();
                if(trIndex>1) {
                $(this).closest("tr").remove();
            } else {
                
            }
        });
    });    
</script>

@endsection