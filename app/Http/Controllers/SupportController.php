<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
}
