@extends('layouts.panel')

@section('title', 'Manage Support Ticket')
    

@section('nav-support-tickets', 'active')

@section('modals')    
<!-- Modal -->
<div class="modal fade" id="AddReplyModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Reply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        <form action="{{ route('admin.support-add-reply') }}" method="post" class="w-100">
          
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    
                    <div style="padding: 23px 23px">
                        <div>
                            <p>Hi <b>{{ $ticket->user->name }}</b>,<br><br>This message is regarding the <b>Ticket #{{$ticket->id}} </b>raised by you.&nbsp;</p>
                        </div>
                        
                        <textarea name="message" id="msg"></textarea>
                        
                        <div>
                            <p><b style="font-size: 1rem;"><br></b></p><p><b style="font-size: 1rem;">Best Regards,</b><br></p><p><span style="font-size: 1rem;"><span style="font-family: Arial;">{{Auth()->user()->name}}</span><br></span><span style="font-size: 1rem;">Computer Reflex Support Team<br></span><a href="tel:+917003373754" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;">+91 7003 373 754</a><span style="font-size: 1rem;">&nbsp;| </span><a href="mailto:contact@computerreflex.tk" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;">contact@computerreflex.tk</a></p><p><br></p>
                        </div>
                    </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Send <i class="far fa-paper-plane"></i></button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="container" style="background-color: white; padding: 24px 32px;">

        <div class="wishlist-basic-padding">
            <span style="font-size: 17px; font-weight: 600;">
                <span>
                    <i class="fas fa-ticket-alt"></i>
                </span>
                <span>
                    {{ $ticket->subject }} - Ticket #{{ $ticket->id }}
                </span>
                @if ($ticket->status != 'resolved')
                <span style="float: right;">
                    <form action="{{ route('support.ticket-mark-resolved') }}" method="post"> @csrf
                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                        <button type="submit" class="btn btn-sm btn-success">Mark as Resolved <i class="fas fa-check-square"></i></button>
                    </form>
                </span>
                @endif
              
            </span>
        </div>

        @error('message')
            <div style="min-height: unset; padding: 0px 16px;">
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div> 
            </div>
        @enderror

        <div style="min-height: unset; padding: 12px 16px;">
            <div class="row">
                <div class="col-md-6">
                    <table style="width: 100%;">
                        <tr style="border-top: 1px solid rgb(199, 199, 199);">
                            <td  style="width: 50%; font-weight: 600; padding: .75rem;">Status:</td>
                            <td style="width: 50%; padding: .75rem;">
                                @if ($ticket->status == 'open')
                                <span class="text-warning">Open</span>
                                @elseif ($ticket->status == 'resolved')    
                                <span class="text-success">Resolved</span>                 
                                @endif
                            </td>
                        </tr>
                        <tr style="border-top: 1px solid rgb(199, 199, 199);">
                            <td style="width: 50%; font-weight: 600; padding: .75rem;">Last Replier:</td>
                            <td style="width: 50%; padding: .75rem;">{{$ticket->msgs[0]->user->name}}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <table style="width: 100%;">
                        <tr style="border-top: 1px solid rgb(199, 199, 199);">
                            <td  style="width: 50%; font-weight: 600; padding: .75rem;">Created Date:</td>
                            <td style="width: 50%; padding: .75rem;">
                                <span>{{ date_format(new DateTime($ticket->created_at), "dS M, Y (H:i)") }}</span>
                            </td>
                        </tr>
                        <tr style="border-top: 1px solid rgb(199, 199, 199);">
                            <td style="width: 50%; font-weight: 600; padding: .75rem;">Last Response:</td>
                            <td style="width: 50%; padding: .75rem;">
                                <span>{{ date_format(new DateTime($ticket->msgs[0]->created_at), "dS M, Y (H:i)") }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
      

        <div style="min-height: unset; padding: 12px 16px;">
            <div class="add-address-box-wrapper" style="margin-bottom: 0;">
                <a data-toggle="modal" data-target="#AddReplyModal">
                    <div class="add-address-box">
                        <img src="{{asset('img/svg/times.svg')}}" alt="" srcset="">
                        <span>ADD REPLY</span>
                    </div>
                </a>
            </div>   
        </div>

        
        @foreach ($ticket->msgs as $msg)

            <div style=" padding: 12px 16px;">
                    <div style="border: 1px rgb(224, 224, 224) solid;">

                
                    <div style="padding: 12px 16px; @if($msg->type == 'staff') background-color: rgb(199, 255, 208); @else background-color: rgb(219, 239, 255); @endif">
                        <div class="ticket-message-container ticket-reply" >

                            <div style="display: flex; ">
                                <div style="padding-left: 0px; padding-right: 10px;">
                                    <img style="border: 1px rgb(192, 192, 192) solid" src="{{ asset('storage/images/dp/'.$ticket->user->dp) }}" alt="" width="40px" height="40px">
                                </div>

                                <div class="user w-100" > 
                                    <span class="name">
                                        <span style="font-weight: 600;">
                                            {{ $msg->user->name }}
                                        </span>

                                        @if ($msg->type == 'staff')
                                            <span class="bg-success" style="
                                            display: inline;
                                            padding: .2em .6em .3em;
                                            font-size: 85%;
                                            line-height: 1;
                                            color: #fff;
                                            text-align: center;
                                            white-space: nowrap;
                                            vertical-align: baseline;">
                                                Staff
                                            </span>
                                        @endif
                                        
                                    </span> 
                                    <div>
                                        <span style="font-size: 12px;">
                                            @if ($msg->type == 'staff')
                                                {{env('CONTACT_EMAIL')}}
                                            @else
                                                {{ $msg->user->email }}
                                            @endif
                                        </span>
                                    </div>     
                                </div>

                                <div class="w-100">
                                    <span style="float: right; width: fit-content;">{{ date_format(new DateTime($msg->created_at), "dS M, Y (H:i)") }}</span>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div style="padding: 12px 16px;">
                       {!! $msg->msg !!}
                    </div>
                </div>
            </div>  
        @endforeach
    
    </div>
@endsection


@section('bottom-js')
    <script>
        $('document').ready(function () {
            $('#msg').summernote({
                height: 250,
            })
        })
    </script>
@endsection