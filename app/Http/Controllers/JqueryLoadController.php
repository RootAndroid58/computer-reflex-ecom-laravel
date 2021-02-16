<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class JqueryLoadController extends Controller
{
    public function CheckoutAddressContainerDiv()
    {
        $addresses = Address::where('user_id', Auth()->user()->id)->get();

        return view('includes.checkout-address-div', [
            'addresses' => $addresses,
        ]);
    }
}
