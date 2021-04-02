@extends('layouts.panel')

@section('title', 'Support Tickets')
    

@section('nav-support-tickets', 'active')
    
@section('content')

<div class="container-fluid">
    
        <!--Products Table Start-->
        <table id="AdminSupportTickets" class="table table-hover table-striped table-bordered table-fluid">
            <thead  class="bg-primary text-white">
            <tr>
                <th style="width: 15%">Ticket #</th>
                <th style="width: 10%">Status</th>
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
    $('#AdminSupportTickets').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminSupportTicketsTable')}}"
        },
        columns: [
            {
                data: 'ticket_id',
                name: 'ticket_id',
            },
            {
                data: 'status',
                name: 'status',
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
</script>
@endsection