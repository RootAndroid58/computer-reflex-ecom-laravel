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
        $req->validate([
            'name'          => 'required',
            'house'         => 'required',
            'locality'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'state'         => 'required',
            'pin_code'      => 'required',
            'mobile'        => 'required',
            'altMobile'     => 'nullable',
        ]);
        
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

    public function EditAddressFetch(Request $req)
    {
        $address = Address::where('id', $req->AddressID)->where('user_id', Auth()->user()->id)->first();
        
        if (isset($address)) {
            return response()->json([
                'address' => $address, 
                ]);
        }
    }

    public function EditAddressSubmit(Request $req)
    {
        
        $req->validate([
            'address_id'    => 'required',
            'name'          => 'required',
            'house'         => 'required',
            'locality'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'state'         => 'required',
            'pin_code'      => 'required',
            'mobile'        => 'required',
            'altMobile'     => 'nullable',
        ]);

        $address = Address::where('id', $req->address_id)->where('user_id', Auth()->user()->id)->first();
        if (isset($address)) {
            $address->update([
                'name'      => $req->name,
                'house_no'  => $req->house,
                'locality'  => $req->locality,
                'city'  => $req->city,
                'district'  => $req->district,
                'state'  => $req->state,
                'pin_code'  => $req->pin_code,
                'mobile'  => $req->mobile,
                'alt_mobile'  => $req->altMobile,
            ]);

            return response()->json([
                'status' => 200, 
            ]);
        }

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
