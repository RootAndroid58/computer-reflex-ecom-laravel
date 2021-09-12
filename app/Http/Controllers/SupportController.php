<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SupportTicket;
use App\Models\SupportTicketMsg;
use App\Mail\AdminSupportTicketReplyMail;
use App\Mail\SupportTicketRaisedMail;
use Auth;
use Mail;

class SupportController extends Controller
{
    public function Support()
    {
        if (!Auth::check()) 
        {
            return redirect()->route('support.contact-us');
        } 
        else 
        {
            return redirect()->route('support.raise-support-ticket');
        }
    }

    public function ContactUs()
    {
        return view('support.contact-us');
    }

    public function SupportTickets ()
    {
        return view('support.support-tickets');
    }

    public function RaiseSupportTicket()
    {
        $orders = Order::where('user_id', Auth()->user()->id)->get();

        return view('support.raise-support-ticket',[
            'orders' => $orders,
        ]);
    }


    // public function RaiseSupportTicketSubmit(Request $req)
    // {
    //     $req->validate([
    //         'ticket_topic'          => 'required',
    //         'ticket_description'    => 'required',
    //     ]);

    //     if ($req->ticket_topic == 'Order Related' || $req->ticket_topic == 'Return/Refund') {
    //         $req->validate([
    //             'order_id'          => 'required',
    //         ]);
    //         $order = Order::where('id', $req->order_id)->where('user_id', Auth()->user()->id)->first();

    //         if ($req->ticket_topic == 'Order Related') {
    //             $subject = 'Order#'.$order->id.' Related';
    //         }
    //         elseif ($req->ticket_topic == 'Return/Refund') {
    //             $subject = 'Return/Refund Related - Order#'.$order->id;
    //         }
    //     } 
    //     else {
    //         $subject = $req->ticket_topic;
    //     }

    //     $SupportTicket = new SupportTicket;
    //     $SupportTicket->user_id = Auth()->user()->id;
    //     $SupportTicket->status = 'open';
    //     $SupportTicket->subject = $subject;
    //     $SupportTicket->save();

    //     $SupportTicketMsg = new SupportTicketMsg; 
    //     $SupportTicketMsg->ticket_id = $SupportTicket->id; 
    //     $SupportTicketMsg->user_id = Auth()->user()->id;   
    //     $SupportTicketMsg->type = 'user';   
    //     $SupportTicketMsg->msg = $req->ticket_description;   
    //     $SupportTicketMsg->save();

    //     foreach ($req->attachments as $key => $attachment) {
    //         # code...
    //     }

    //     SupportTicketMsg::where('id', $SupportTicketMsg->id)->update([
    //         'attachments' => '',
    //     ]);

    //     $ticket = SupportTicket::with('user')->where('id', $SupportTicket->id)->first();

    //     // Send Ticket Raised Confirmation Mail To The User
    //     $data = [
    //         'ticket' => $ticket,
    //     ];
    //     Mail::to($ticket->user->email)->send(new SupportTicketRaisedMail($data));


    //     return redirect()->route('support.show-ticket', $SupportTicket->id)->with([
    //         'ticket_raised' => $SupportTicket->id,
    //     ]);
    // }

    public function AddReply(Request $req)
    {
        $req->validate([
            'ticket_id' => 'required',
            'message'   => 'required',
        ]);

        $ticket = SupportTicket::where('id', $req->ticket_id)->first();

        if ($ticket->user_id == Auth()->user()->id) 
        {
            
            $SupportTicketMsg = new SupportTicketMsg;
            $SupportTicketMsg->ticket_id = $req->ticket_id;
            $SupportTicketMsg->user_id = Auth()->user()->id;
            $SupportTicketMsg->type = 'user';
            $SupportTicketMsg->msg = $req->message; 
            $SupportTicketMsg->save();
        } 

        SupportTicket::where('id', $req->ticket_id)->update([
            'status' => 'open',
        ]);

        return redirect()->back();
    }

    public function AdminAddReply(Request $req)
    {
        $req->validate([
            'ticket_id' => 'required',
            'message'   => 'required',
        ]);

        $ticket = SupportTicket::with('user')->where('id', $req->ticket_id)->first();

        SupportTicket::where('id', $req->ticket_id)->update([
            'status' => 'open',
        ]);

        $header = '<p>Hi <b>'.$ticket->user->name.'</b>,<br><br>This message is regarding the <b>Ticket #'.$ticket->id.' </b>raised by you.&nbsp;</p>';
        $body   = $req->message;    
        $footer = '<p><b style="font-size: 1rem;"><br></b></p><p><b style="font-size: 1rem;">Best Regards,</b><br></p><p><span style="font-size: 1rem;"><span style="font-family: Arial;">'.Auth()->user()->name.'</span><br></span><span style="font-size: 1rem;">Computer Reflex Support Team<br></span><a href="tel:+917003373754" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;">+91 7003 373 754</a><span style="font-size: 1rem;">&nbsp;| </span><a href="mailto:contact@computerreflex.tk" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;">contact@computerreflex.tk</a></p><p><br></p>';
        $msg = $header.$body.$footer;

        $SupportTicketMsg = new SupportTicketMsg;
        $SupportTicketMsg->ticket_id = $req->ticket_id;
        $SupportTicketMsg->user_id = Auth()->user()->id;
        $SupportTicketMsg->type = 'staff';
        $SupportTicketMsg->msg = $msg; 
        $SupportTicketMsg->save();

        // Send Notification Mail To User
        $data = [
            'ticket'    => $ticket, 
            'header'    => $header,
            'body'      => $body,
            'footer'    => $footer,
        ];
        
        Mail::to($ticket->user->email)->send(new AdminSupportTicketReplyMail($data));

        return redirect()->back();
    }


    public function ShowTicket($ticket_id)
    {
        $SupportTicket = SupportTicket::with('msgs')->with('user')->where('id', $ticket_id)->where('user_id', Auth()->user()->id)->first();
        
        if (!isset($SupportTicket)) {
            abort(404);
        }
        
        return view('support.ticket-index', [
            'ticket' => $SupportTicket,
        ]);
    }

    public function AdminShowTicketsPage()
    {
        return view('admin.support-ticket.support-tickets');
    }

    public function AdminManageTicketPage($ticket_id)
    {
        $SupportTicket = SupportTicket::with('msgs')->with('user')->where('id', $ticket_id)->first();
        return view('admin.support-ticket.manage-ticket', [
            'ticket' => $SupportTicket,
        ]);
    }

    public function MarkAsResolved(Request $req)
    {
        $ticket = SupportTicket::where('id', $req->ticket_id)->first();

        if ($ticket->user_id == Auth()->user()->id || Auth()->user()->can('Admin')) {
            SupportTicket::where('id', $req->ticket_id)->update([
                'status' => 'resolved',
            ]);
        } else {
            abort(505);
        }
        

        return redirect()->back();
    }
}
