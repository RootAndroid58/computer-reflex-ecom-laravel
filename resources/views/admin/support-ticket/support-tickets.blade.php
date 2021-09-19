@extends('layouts.panel')

@section('title', 'Support Tickets')
    

@section('nav-support-tickets', 'active')
    
@section('content')

<div class="container-fluid">
    
    <h3>Support Tickets</h3>

    {{ Breadcrumbs::render() }}
        <!--Products Table Start-->
        <table id="AdminSupportTickets" class="table table-hover table-striped table-bordered table-fluid">
            <thead  class="bg-primary text-white">
            <tr>
                <th style="width: 15%">Ticket #</th>
                <th style="width: 10%">
                    <select name="status" id="search_status" class="form-control">
                        <option value="all" selected>Status (All)</option>
                        <option value="open">Open</option>
                        <option value="resolved">Resolved</option>
                    </select>
                </th>
                <th style="width: 30%">Subject</th>
                <th style="width: 25%">Last Replier</th>
                <th style="width: 20%">Created At</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
                <th>Ticket #</th>
                <th>Status</th>
                <th>Subject</th>
                <th>Last Replier</th>
                <th>Created At</th>
            </tr>
            </tfoot>
        </table>
    
</div>

@endsection


@section('bottom-js')
<script>

    $('document').ready(function () {
        loadDataTable();
    });

    $('#search_status').on('change', function () {
        $('#AdminSupportTickets').DataTable().destroy();
        loadDataTable();
    });

function loadDataTable() {

    var status = $('#search_status').val();

    $('#AdminSupportTickets').DataTable({
        processing: true,
        serverSide: true, 
        ajax:{
            url: "{{route('ajax-datatable.AdminSupportTicketsTable')}}",
            data: { search_status:$('#search_status').val() },
        },
        columns: [
            {
                data: 'ticket_id',
                name: 'ticket_id',
            },
            {
                data        : 'status',
                name        : 'status',
                orderable   : false,
            },
            {
                data: 'subject',
                name: 'subject',
            },
            {
                data: 'last_replier',
                name: 'last_replier',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ]
    });
}


</script>
@endsection