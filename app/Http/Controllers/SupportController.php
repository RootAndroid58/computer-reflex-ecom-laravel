<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function Support()
    {
        return view('support.raise-support-ticket');
    }

    public function SupportTickets ()
    {
        # code...
    }

    public function RaiseSupportTicket()
    {
        return view('support.raise-support-ticket');
    }
}
