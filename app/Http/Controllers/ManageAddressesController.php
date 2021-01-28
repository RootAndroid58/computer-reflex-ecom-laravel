<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageAddressesController extends Controller
{
    public function ShowAddresses()
    {
        return view('manage-addresses');
    }
}
