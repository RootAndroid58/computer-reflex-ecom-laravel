<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class ManageAddressesController extends Controller
{
    public function ShowAddresses()
    {
        $addresses = Address::where('user_id', Auth()->user()->id)->get();

        return view('manage-addresses',[
            'addresses' => $addresses,
        ]);
    }

    public function AddAddress(Request $req)
    {
        
        $Address = new Address;

        $Address->user_id       = Auth()->user()->id;
        $Address->name          = $req->name;
        $Address->house_no      = $req->house;
        $Address->locality      = $req->locality;
        $Address->city          = $req->city;
        $Address->district      = $req->district;
        $Address->state         = $req->state;
        $Address->pin_code      = $req->pin_code;
        $Address->mobile        = $req->mobile;
        $Address->alt_mobile    = $req->altMobile;

        $Address->save();

        return response()->json([
            'status' => 200, 
            ]);
     

    }

    public function EditAddress(Request $req)
    {
        # code...
    }

    public function RemoveAddress(Request $req)
    {
        $address = Address::where('id', $req->AddressID)->where('user_id', Auth()->user()->id)->first();

        if (isset($address)) {
            $address->delete();
            
            return 200;
        }
    }
}
