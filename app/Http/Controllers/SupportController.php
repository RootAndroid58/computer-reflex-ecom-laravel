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
        return view('support.raise-support-ticket');
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
