@if (isMobile())

    @include('mobile.support.support-tickets')

{{ die }}
@endif

@extends('layouts.support-menu-layout')

@section('nav-support-tickets', 'account-menu-item-active')

@section('title', 'Raise Support Ticket')

@section('right-menu-col')
<div class="right-account-container" style="padding: 0;">
   
    <div class="wishlist-basic-padding">
        <span style="font-size: 17px; font-weight: 600;">
            <span>
                <i class="fas fa-ticket-alt"></i>&nbsp;
            </span>
            <span>
                My Support Tickets
            </span>
        </span>
    </div>


    <div class="wishlist-basic-padding" style="padding-top: 0;">

        <!--Products Table Start-->
        <table id="ReferredPurchasesTable" class="table table-hover table-striped table-bordered table-fluid">
            <thead class="thead-dark">
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


</div>
@endsection



@section('bottom-js')
<script>
        
    $('#ReferredPurchasesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.SupportTicketsTable')}}"
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