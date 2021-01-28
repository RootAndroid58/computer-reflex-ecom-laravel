<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Storage;
use Auth;

class DpUpdateController extends Controller
{
    public function DpUpdate(Request $req)
    {
        $req->validate([
            'dp' => 'mimes:jpeg,jpg,png|required|max:2000' // max 2 mb
        ]);

            if (Auth()->user()->dp != 'default.png') {
                Storage::delete('/public/images/dp/'.auth()->user()->dp);
            }

                
        $req->dp->store('images/dp' , 'public');
        
        
        auth()->user()->update(['dp' => $req->dp->hashName()]);

        return redirect()->back();
    }
}
