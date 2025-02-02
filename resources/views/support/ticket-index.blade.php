@if (isMobile())
    @include('mobile.support.ticket-index')
{{ die }}
@endif


@extends('layouts.support-menu-layout')

@section('nav-support-tickets', 'account-menu-item-active')

@section('title', 'Support Ticket #'.$ticket->id)

@section('css-js')

@endsection

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

            @livewire('support.user-add-ticket-reply', ['ticket' => $ticket])

        </div>
    </div>
</div>
@endsection

@section('right-menu-col')

<div class="right-account-container account-details-container" style="padding: 0;">

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

        <div style="min-height: unset; padding: 12px 16px;">
            <div class="row mb-3">
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

            @if ($ticket->status == 'resolved')
                <div class="alert alert-info" role="alert" style="margin: 0;">
                    <strong>This is ticket is marked as "Resolved" adding an reply will Reopen the ticket.</strong>
                </div>
            @endif
        </div>

        @error('message')
            <div style="min-height: unset; padding: 0px 16px;">
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div> 
            </div>
        @enderror
      

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
                                    <img style="border: 1px rgb(192, 192, 192) solid" src="{{ profilePicture($ticket->user->dp) }}" alt="" width="40px" height="40px">
                                </div>

                                <div class="user w-100" > 
                                    <span class="name">
                                        <span style="font-weight: 600;">
                                            {{$msg->user->name}}
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

                    <div style="padding: 12px 16px;" class="ticketHtmlBody">
                       {!! $msg->msg !!}
                    </div>
                    {{-- {{dd($msg)}} --}}
                    @if (count($msg->attachments) > 0)
                    
                    <div style="padding: 12px 16px; border-top: 1px rgb(224, 224, 224) solid;">
                        <div>
                            <div class="" style="font-weight: 600">Attachments({{count($msg->attachments)}})</div>
                                <ul>
                                    @foreach ($msg->attachments as $attachment)
                                
                                        <li>
                                            <a class="text-primary" href="{{ Storage::url('attachments/'.$attachment->attachment) }}" target="_blank">{{ $attachment->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                    @endif
                   

                   
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
        });
    </script>
@endsection