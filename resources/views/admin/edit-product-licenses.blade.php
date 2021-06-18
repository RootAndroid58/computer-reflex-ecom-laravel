@extends('layouts.panel')

@section('title', 'Edit Product Lincenses')

@section('modals')
<div class="modal fade" id="newKeyModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    @livewire('create-license-key-modal', ['product' => $product])
</div>
<div class="modal fade" id="bulkModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    @livewire('bulk-license-key-modal', ['product' => $product])
</div>
@endsection

@section('content')

<div class="container-fluid">
    
<h3>License Keys</h3>
<div class="mb-3">
    <span style="font-size: 15px;" class="text-muted">{{ $product->product_name }}</span>
</div>

<div class="w-100 text-right mb-3">
    <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#bulkModal">Bulk Upload <i class="fas fa-cloud-upload-alt"></i></button>
    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#newKeyModal" id="newKeyBtn">New License Key <i class="fas fa-plus"></i></button>
</div>

<table id="AdminProductLicensesTable" class="table table-striped table-bordered table-fluid w-100">
    <thead class="bg-secondary text-white">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 35%">Liecnse Key</th>
        <th style="width: 20%">Created At</th>
        <th style="width: 20%">Last Updated</th>
        <th style="width: 20%">Status</th>
        <th style="width: 20%">Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 35%">Liecnse Key</th>
        <th style="width: 20%">Created At</th>
        <th style="width: 20%">Last Updated</th>
        <th style="width: 20%">Status</th>
        <th style="width: 20%">Action</th>
    </tr>
    </tfoot>
</table>


</div>
@endsection




@section('bottom-js')




<script>

    $('body').on('keyup', '#bulkKeysTextarea', function () {
        var newVal = $(this).val().split(" ").join("\n").replace(/^\s*[\r\n]/gm, '');
        $(this).val(newVal);
    });

    var table = $('#AdminProductLicensesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('datatable-product-licenses-table.index') }}",
            data: {
                product_id: {{ $product->id }},
            },
        },
        columns: [
            {
                data: 'license_id',
                name: 'license_id',
            },
            {
                data: 'license_key',
                name: 'license_key',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
            {
                data: 'updated_at',
                name: 'updated_at',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'action',
                name: 'action',
            },
        ]
    });

    Livewire.on('ProductLicenseCreated', data => {
        $('#newKeyModal').modal('toggle');
        $('#newKeyModal').find('form').trigger("reset");
        Toast.create(`License Key Added`, data.key, TOAST_STATUS.SUCCESS, 5000);
        table.ajax.reload();
    });

    Livewire.on('BulkUploaded', function () {
        $('#bulkModal').modal('toggle');
        $('#bulkModal').find('form').trigger("reset");
        table.ajax.reload();
    })

        
    /* Delete customer */
    $('body').on('click', '#delete-key', function () {
        var key_id = $(this).data("key-id");
        var token = $("meta[name='csrf-token']").attr("content");
        var url = '{{ route("datatable-product-licenses-table.destroy", ":id") }}';
        url = url.replace(':id', key_id);

        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: url,
            data: {
            "id": key_id,
            "_token": token,
            },
            success: function (data) {
                Toast.create(`License Key Deleted`, data.license_key, TOAST_STATUS.DANGER, 5000);
                table.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>

@endsection
