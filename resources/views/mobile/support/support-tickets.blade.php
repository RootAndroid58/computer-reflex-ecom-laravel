@extends('layouts.mobile-common')

@section('title', 'Raise Support Ticket')

@section('burger-support-tickets-menu', 'account-menu-item-active')

@section('css-js')
    <style>
      .dataTables_filter, .dataTables_length{
        text-align: left !important;
      }
      .dataTables_length {
        padding-left: 15px;
      }
    </style>
@endsection

@section('content')
<div class="container-fluid" >
   
  <div class="mt-3 mb-3">
      <span style="font-size: 17px; font-weight: 600;">
          <span>
              <i class="fas fa-ticket-alt"></i>&nbsp;
          </span>
          <span>
              My Support Tickets
          </span>
      </span>
  </div>


  <div class="" >

      <!--Products Table Start-->
      <div class="table-responsive">
        <table id="ReferredPurchasesTable" class="table table-hover table-striped table-bordered table-fluid">
          <thead class="thead-dark">
          <tr>
              <th style="width: 30%">Ticket #</th>
              <th style="width: 30%">Status</th>
              <th style="width: 30%">Subject</th>
              <th style="width: 30%">Last Replier</th>
              <th style="width: 30%">Created At</th>
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


</div>
@endsection



@section('bottom-js')
<script>
        
    $('#ReferredPurchasesTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
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
    new $.fn.dataTable.FixedHeader( table );
    </script>
@endsection