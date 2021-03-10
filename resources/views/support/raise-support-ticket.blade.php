@extends('layouts.common')

@section('title', 'Support')

@section('content')
    <div class="body-container">



    <div class="container" style="padding-right: 0px; padding-left: 15px;">
      
            <div class="account-details-container w-100 row">
               <div class="col-12">
                    <div class="wishlist-basic-padding" >
                        <div class="account-details-title" style="padding-bottom: 0px;">
                            <img src="{{asset('img/svg/active-support.svg')}}" width="50">
                            <span style="padding-right: 0; padding-left: 10px;" >Hi, <font style="font-weight: 600;">{{FirstWord(Auth()->user()->name)}}</font>. What can we help you with?</span>
                        </div>
                    </div>
               </div>
            </div>
      
    </div>





<div class="container">




    <div class="row">

    <div class="col-md-3">        
                <div class="account-details-container row">
                    

                    <div class="account-menu-break"></div> 

                    <div class="account-menu-items-container">
                        <div class="account-head-menu">
                            <img style="width: 25px;" src="{{asset('img/svg/call-center-worker.svg')}}" alt="" srcset="">
                            <a style="cursor: default">GET IN TOUCH</a>
                        </div>
                    </div>
                        
                    
                    <div class="w-100" style="padding-bottom: 12px;">
                        <a style="width: 100%;" href="{{route('raise-support-ticket')}}"><div class="account-menu-item account-menu-item-active">Raise Support Ticket</div></a>
                        <a style="width: 100%;" href="{{route('support-tickets')}}"><div class="account-menu-item ">Support Tickets</div></a>
                        <a style="width: 100%;" href="#"><div class="account-menu-item">Contact Us</div></a>
                    </div>


                    <div class="account-menu-break"></div> 

                    <div class="account-menu-items-container">
                        <div class="account-head-menu">
                            <img src="http://localhost:8000/img/svg/stuff.svg" alt="" srcset="">
                            <a style="cursor: default; width: 100%;">MY STUFF</a>
                        </div>
                    </div>

                    <div class="w-100" style="padding-bottom: 12px;">
                        <a href="http://localhost:8000/wishlist"><div class="account-menu-item ">My Wishlist</div></a>
                    </div>
                    
                    <div class="account-menu-break"></div> 

                    <div class="account-menu-items-container" style="cursor: pointer;">
                        <div class="account-head-menu">
                            <img src="http://localhost:8000/img/svg/logout.jpg" alt="" srcset="">
                            <a style="width: 100%;" href="http://localhost:8000/logout">Logout</a>
                        </div>
                    </div>


            </div>
    </div>


        <div class="col-md-9">

                        
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


    </div>
</div>
</div>
    

</div>
@endsection

@section('bottom-js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection