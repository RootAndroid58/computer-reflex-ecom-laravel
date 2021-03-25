@extends('layouts.support-menu-layout')

@section('nav-raise-support-ticket', 'account-menu-item-active')

@section('title', 'Raise Support Ticket')

@section('right-menu-col')
<div class="right-account-container account-details-container">
                
    <form action="" method="post">
        <div class="form-group">
          <label for="subject">Subject <font style="color: red;">*</font></label>
          <input type="text"
            class="form-control" name="" id="subject" aria-describedby="helpId" placeholder="Enter The Subject Here">
        </div>

        <div class="form-group">
          <label for="">Help Topic <font style="color: red;">*</font></label>
          <select class="form-control" name="" id="">
            <option value="General Query">General Query</option>
            <option value="General Query">Account Related</option>
            <option value="Order Related">Order Related</option>
            <option value="Return/Refund">Return/Replace</option>
            <option value="Payment Related">Payment Related</option>
            <option value="Technical Problem">Technical Problem</option>
          </select>
        </div>

        
       
          <textarea name="" id="summernote"></textarea>
     

        <div style="text-align: right;">
            <button type="submit" class="btn btn-success">Submit Ticket</button>
        </div>
        
    </form>

</div>
@endsection

@section('bottom-js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
              height: 250,
            });
        });
    </script>
@endsection