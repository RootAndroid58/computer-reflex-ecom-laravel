@extends('layouts.panel')

@section('nav-manage-ui', 'active')
@section('title','Home Carousel Sliders')

@section('css-js')

@endsection


@section('content')


<div class="container-fluid">

<h3>Featured Catalogs</h3>

@if (Session::has('catalogCreated'))
    <div class="alert alert-success" role="alert">
        <strong>Catalog Created Successfully. Link: {{ route('show-catalog', Session('catalogCreated')) }}</strong>
    </div>
@endif


<div class="row mt-3 mb-3">
    <div class="col-12">
        <a class="btn btn-primary float-right" href="{{ route('admin-create-new-catalog') }}">Create New Catalog</a>
    </div>
</div>


    


<table id="AdminCatalogsTable" class="table table-striped table-bordered w-100">
    <thead class="bg-primary text-white">
        <th style="width: 5%">#</th>
        <th style="width: 20%">Slug</th>
        <th style="width: 15%">Total Products</th>
        <th style="width: 10%">Action</th>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th >#</th>
        <th >Slug</th>
        <th >Total Products</th>
        <th >Action</th>
    </tr>
    </tfoot>
</table>


</div> <!--Container-Fluid End-->


@endsection



@section('bottom-js')



<script>

    $('#AdminCatalogsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminFeaturedCatalogsTable')}}"
        },
        columns: [
            {
                data: 'catalog_id',
                name: 'catalog_id',
            },
            {
                data: 'slug',
                name: 'slug',
            },
            {
                data: 'total_products',
                name: 'total_products',
            },
            {
                data: 'action',
                name: 'action',
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