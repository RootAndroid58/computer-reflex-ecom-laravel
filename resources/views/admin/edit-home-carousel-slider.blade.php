@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Edit Home Carousel Slider')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

<h3>Edit Home Carousel Slider</h3>
<br>


            <form action="{{ route('admin-edit-home-carousel-sliders-submit') }}" method="post" class="mt-3 mb-3"> @csrf
                <input type="hidden" name="home_section_id" value="{{ $HomeSection->id }}">
                <div class="row">
                    <div class="form-group col-6">
                    <label for="section_title">Section Title (Header)</label>
                    <input type="text" required value="{{ $HomeSection->title }}"
                        class="form-control" name="title" id="section_title" aria-describedby="helpId" placeholder="Section Title">
                    </div>

                    <div class="form-group col-6">
                    <label for="section_caption">Section Caption</label>
                    <input type="text" required value="{{ $HomeSection->caption }}"
                        class="form-control" name="caption" id="section_caption" aria-describedby="helpId" placeholder="Section Caption">
                    </div>
                </div>
                <p>Products List (Add Products From Below Table)</p>
                
            <div class="products-list-container">
                @foreach ($HomeSection->SectionProducts as $SectionProduct)
                <div class="SectionProduct{{ $SectionProduct->product->id }} ">        
                    <input type="hidden" name="product_ids[]" value="{{ $SectionProduct->product->id }} ">
                    <div class="row">
                        <div class="col-2">
                            <img width="100%" src="{{ asset('storage/images/products/'.$SectionProduct->product->images[0]->image) }}" alt="" srcset="">
                        </div>
                        <div class="col-8">
                            {{ $SectionProduct->product->product_name }} 
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger" onclick="RemoveFromSlider({{ $SectionProduct->product->id }})">Remove</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>






                <button type="submit" class="btn btn-success">Edit Slider</button>

                
            </form>







    <!--Products Table Start-->
    <table id="AdminProductsTable" class="table table-striped table-bordered w-100">
        <thead class="bg-primary text-white">
        <tr>
            <th style="width: 5%">#</th>
            <th style="width: 20%">Product Name</th>
            <th style="width: 15%">Brand</th>
            <th style="width: 10%">MRP</th>
            <th style="width: 10%">Price</th>
            <th style="width: 10%">Stock</th>
            <th style="width: 10%">Status</th>
            <th style="width: 20%">Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>MRP</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>



    


</div> <!--Container-Fluid End-->


@endsection



@section('bottom-js')
<script>
    function AddToSlider(product_id, image, product_name) {

        if($(".SectionProduct"+product_id).length){
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Product Already Exists.", {
                type: "danger",
                offset: {from:"bottom", amount: 50},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else {
        $('.products-list-container').append(
        `
        <div class="SectionProduct`+product_id+`">        
        <input type="hidden" name="product_ids[]" value="`+product_id+`">
        <div class="row">
            <div class="col-2">
                <img width="100%" src="`+image+`" alt="" srcset="">
            </div>
            <div class="col-8">
                `+product_name+`
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-danger" onclick="RemoveFromSlider(`+product_id+`)">Remove</button>
            </div>
        </div>
        </div>
        `);
        }
    }

    function RemoveFromSlider(product_id) {
        console.log(product_id);
        $('.SectionProduct'+product_id).remove();
    }
</script>



<script>

    $('#AdminProductsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminSliderProductsTable')}}"
        },
        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'product_name',
                name: 'product_name',
            },
            {
                data: 'product_brand',
                name: 'product_brand',
            },
            {
                data: 'product_mrp_custom',
                name: 'product_mrp_custom',
            },
            {
                data: 'product_price_custom',
                name: 'product_price_custom',
            },
            {
                data: 'stock',
                name: 'stock',
            },
            {
                data: 'product_status',
                name: 'product_status',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
            },
        ]



    });
</script>


    <script>
        function ChangePage(section_id) {
            $('.PageSection').addClass('d-none')
            $('#'+section_id).removeClass('d-none')
        }
    </script>
@endsection