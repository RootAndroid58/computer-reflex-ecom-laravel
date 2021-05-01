@if (isMobile())

    @include('mobile.affiliate.wallet')

{{ die }}
@endif


@extends('layouts.affiliate-menu-layout')

@section('title', 'Affiliate Wallet')

@section('wallet-nav', 'account-menu-item-active')

@section('right-col-menu')
    
     
<div class="right-account-container account-details-container"style="padding: 24px 24px;">
     
<div class="container-fluid">
    <h5 class="mb-3" style="font-weight: 600;">Affiliate Wallet</h5>
</div>
  
<div class="container-fluid">

  <div class="row">
    <div class="col-4">
      <div class="alert alert-success" role="alert">
        <strong>Wallet Balance</strong>
        <div>
          <font class="rupees">₹</font>{{ moneyFormatIndia(App\Models\AffiliateWalletTxn::where('user_id', Auth()->user()->id)->orderBy('id', 'desc')->first('cb')->cb ?? '0') }}
        </div>
      </div>
    </div>
    
  </div>


<!--Wallet Txns Table Start-->
<table id="WalletTxnTable" class="table table-striped table-bordered table-fluid">
  <thead class="bg-secondary text-white">
  <tr>
    <th style="width: 10%">Txn #ID</th>
    <th style="width: 15%">Date</th>
    <th style="width: 35%">Description</th>
    <th style="width: 10%">Type</th>
    <th style="width: 15%">Amount</th>
    <th style="width: 15%">Closing Balance</th>
  </tr>
  </thead>
  <tbody>

  </tbody>
  <tfoot>
  <tr>
    <th style="width: 10%">Txn #ID</th>
    <th style="width: 15%">Date</th>
    <th style="width: 35%">Description</th>
    <th style="width: 10%">Type</th>
    <th style="width: 15%">Amount</th>
    <th style="width: 15%">Closing Balance</th>
  </tr>
  </tfoot>
</table>

  
</div>

</div>


@endsection
    
@section('bottom-js')
    <script>
          $('#WalletTxnTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.WalletTxnTable')}}"
        },
        columns: [
            {
                data: 'txn_id',
                name: 'txn_id',
            },
            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'description',
                name: 'description',
            },
            {
                data: 'type',
                name: 'type',
            },
            {
                data: 'amount',
                name: 'amount',
            },
            {
                data: 'cb',
                name: 'cb',
            },
        ]
    });
    </script>
@endsection