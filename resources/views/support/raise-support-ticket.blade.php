@if (isMobile())

    @include('mobile.support.raise-support-ticket')

{{ die }}
@endif

@extends('layouts.support-menu-layout')

@section('nav-raise-support-ticket', 'account-menu-item-active')

@section('title', 'Raise Support Ticket')

@section('right-menu-col')
<div class="right-account-container account-details-container">
                
    <form action="{{ route('support.raise-support-ticket-submit') }}" method="post"> @csrf

        <div class="form-group">
          <label for="help_topic">Help Topic <font style="color: red;">*</font></label>
          <select class="form-control" name="ticket_topic" id="help_topic" required>
            <option value="General Query">General Query</option>
            <option value="General Query">Account Related</option>
            <option value="Order Related">Order Related</option>
            <option value="Return/Refund">Return/Replace</option>
            <option value="Payment Related">Payment Related</option>
            <option value="Technical Problem">Technical Problem</option>
          </select>
        </div>

        <div id="subOptionDiv" class="form-group"></div>
        

        <div class="form-group">
          <label class="text-dark">Explain your issue</label>
          <textarea required name="ticket_description" id="description" class="form-control" rows="7"></textarea>
      </div>
    
        <div style="text-align: right;">
            <button type="submit" class="btn btn-success">Submit Ticket</button>
        </div>
        
    </form>


    <div class="d-none">

      <div class="form-group" id="forOrders">
        <label for="order_id_select">Order ID: <font style="color: red;">*</font></label>
        <select class="form-control" name="order_id" id="order_id_select" required>
          @foreach ($orders as $order)
          <option value="{{$order->id}}">#{{ $order->id }}</option>
          @endforeach
        </select>
      </div>

    </div>

</div>
@endsection

@section('bottom-js')
    <script>
        $(document).ready(function() {
            $('#description').summernote({
              height: 250,
            });
        });
    </script>
@endsection