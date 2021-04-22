@extends('layouts.panel')

@section('nav-manage-products', 'active')
@section('title','Edit Product')

@section('css-js')
<style>
    .tagit{
        height: 40vh;
        border-radius: 10px;
        border-color: black;
    }
</style>
@endsection


@section('content')


<div class="container-fluid">

<h3>Edit Product &nbsp;<a class="btn btn-primary btn-sm float-right" href="{{ route('edit-product-images', $product->id)}}">Edit Images</a></h3>

@if(Session::has('ProductEdited'))
    <div class="alert alert-success" id="admin_user_created_alert" role="alert">
        Product edited successfully.
    </div>
@endif


        <div class="container" style="margin-bottom: 100px;">
            
        <form action="{{ route('edit-product-submit') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <label class="text-dark">Product Name</label>
                        <input name="product_name" maxlength="120" class="form-control @error('product_name') is-invalid @enderror" placeholder="Name of the product you wanna list." value="{{old('product_name') ?? $product->product_name}}" required>
                        @error('product_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                      <label for="product_status">Status</label>
                      <select class="form-control" name="product_status" id="product_status" required>
                        <option value="0" @if ($product->product_status == 0) selected @endif>Inactive</option>
                        <option value="1" @if ($product->product_status == 1) selected @endif>Active</option>
                      </select>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-dark">Product MRP (INR)</label>
                        <input name="product_mrp" id="product_mrp" class="form-control @error('product_mrp') is-invalid @enderror" placeholder="&#8377; Product MRP (INR)." value="{{ $product->product_mrp }}" required>
                        <small class="text-muted" id="sHelpText">MRP printed on product.</small>
                        @error('product_mrp')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>            
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-dark">Selling Price (INR)</label>
                        <input name="product_price" id="product_price" class="form-control @error('product_price') is-invalid @enderror" placeholder="&#8377; Selling Price (INR)." value="{{ $product->product_price }}" required>
                        <small class="text-muted" id="sHelpText">Selling Price.</small>
                        <div class="invalid-feedback">Selling price can't be greater than MRP!</div>
                        @error('product_price')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>            
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-dark">Discount (%)</label>
                        <input id="discount" class="form-control" placeholder="% Discount." readonly>
                        <small class="text-muted" id="sHelpText">Discount auto calculated.</small>
                        <div class="invalid-feedback">Selling price can't be greater than MRP!</div>
                    </div>
                </div> 
                <div class="col-3">
                    <div class="form-group">
                      <label for="product_stock">Stock</label>
                      <input type="number" class="form-control" name="product_stock" id="product_stock" value="{{$product->product_stock}}" required>
                      <small id="helpId" class="form-text text-muted">Enter <b>0</b> for No Stock</small>
                    </div>
                </div>           
                <div class="col-3">
                    <div class="form-group">
                      <label for="product_stock">Affiliate Comission</label>
                      <input type="number" class="form-control" name="comission" id="comission" value="{{ $product->comission->comission ?? '' }}" placeholder="% Comission" required>
                      <small id="helpId" class="form-text text-muted">In Percentage (%)</small>
                    </div>
                </div>           
            </div>




            <table  class="table table-hover small-text" id="tb2">
                <tr class="tr-header">
                    <td class="text-center"><strong>Specification</strong></td>
                    <td class="text-center"><strong>Value</strong></td>     
                    <td> <a href="javascript:void(0);" class="btn btn-primary btn-sm float-right" id="addMore2" title="Add More Person">Add More &nbsp;<i class="fa fa-plus-square"></i></a></td>     
                </tr>

                @if ($specifications->count() < 1)
                <tr>
                    <td>
                        <div class="form-group">
                            <input name="key[]" class="form-control @error('key[]') is-invalid @enderror" placeholder="Specification Name" value="" required>
                            @error('key[]')<span class="invalid-feedback">{{$message}}</span>@enderror
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input name="value[]" class="form-control @error('value[]') is-invalid @enderror" placeholder="Specification Value"  value="" required>
                            @error('value[]')<span class="invalid-feedback">{{$message}}</span>@enderror
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm remove">&nbsp;<i class="fa fa-times"></i>&nbsp;</a>
                    </td>
                    <hr>
                </tr>
                @endif

                @foreach ($specifications as $specification)
                <tr>
                    <td>
                        <div class="form-group">
                            <input name="key[]" class="form-control @error('key[]') is-invalid @enderror" placeholder="Specification Name" value="{{old('key[]') ?? $specification->specification_key }}" required>
                            @error('key[]')<span class="invalid-feedback">{{$message}}</span>@enderror
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input name="value[]" class="form-control @error('value[]') is-invalid @enderror" placeholder="Specification Value"  value="{{old('value[]') ?? $specification->specification_value }}" required>
                            @error('value[]')<span class="invalid-feedback">{{$message}}</span>@enderror
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm remove">&nbsp;<i class="fa fa-times"></i>&nbsp;</a>
                    </td>
                    <hr>
                </tr>
                @endforeach


            </table>








            <div class="form-group">
                <label class="text-dark">Short Description</label>
                <textarea name="product_description" id="description" class="form-control @error('product_description') is-invalid @enderror" placeholder="Product description." rows="7"></textarea>
                @error('product_description')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="text-dark">Detailed Description</label>
                <textarea name="product_long_description" id="long_description" class="form-control @error('product_description') is-invalid @enderror" placeholder="Product description." rows="7"></textarea>
                @error('product_description')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>



            <hr>




            <ul id="myTags">
                @foreach ($tags as $tag)
                    <li>{{ $tag->product_tag }}</li>
                @endforeach
            </ul>
            @error('tags')
                <span class="text-danger">{{$message}}</span>
            @enderror
           


            <button type="submit" class="btn btn-primary float-right">Save Changes</button>
        </form>

    </div>


            



<div class="d-none" id="prefilledDescription">{!! $product->product_description !!}</div>
<div class="d-none" id="prefilledLongDescription">{!! $product->product_long_description !!}</div>


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


<script>
    $(document).ready(function() {

        // Description
        $('#description').summernote({
        toolbar: [
        ['color', ['color']],
        ['style', ['bold', 'italic', 'underline', 'clear', ]],
        ['view', ['codeview']],
        ['para', ['ul', 'ol']],
        ['table', ['table']],
    ],
            minHeight: 220,         // set minimum height of editor
            maxHeight: 500,         // set maximum height of editor
            focus: true,    
        }).summernote('code', $('#prefilledDescription').html()); 

        // Long Description
        $('#long_description').summernote({
        toolbar: [
        ['color', ['color']],
        ['para', ['ul', 'ol']],
        ['table', ['table']],
        ['style', ['bold', 'italic', 'underline', 'clear', ]],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['codeview']]
    ],
            minHeight: 220,         // set minimum height of editor
            maxHeight: 500,         // set maximum height of editor
            focus: true,    
        }).summernote('code', $('#prefilledLongDescription').html()); 


    });
</script>


<script>
    $(document).ready(function(){
        $(document).on('mouseover mouseout keyup','body *',function() {
        var m = parseInt($('#product_mrp').val()); 
        var s = parseInt($('#product_price').val());
        var perc="";

        if (s>m) {
            $('#discount').val('')
            $('#discount').addClass('is-invalid')
            $('#sHelpText').addClass('d-none')
            $('#product_price').addClass('is-invalid')
        } else {
            $('#discount').removeClass('is-invalid')
            $('#sHelpText').removeClass('d-none')
            $('#product_price').removeClass('is-invalid')
            if(isNaN(m) || isNaN(s)){
                perc="";
            } else { 
            perc = (((m - s)/m)*100).toFixed(0);
           }
           $('#discount').val(perc+'%');
        }
        })
        })
</script>


<script>
        $(document).ready(function() {
            $("#myTags").tagit({
                fieldName: "tags[]",
                autocomplete: false,
                allowSpaces: true,
            });
            
        });
</script>

@endsection