<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Storage;
use Auth;

class DpUpdateController extends Controller
{
    public function DpUpdate(Request $req)
    {
        if ($req->type == 'base64data') {
            
            if (Auth()->user()->dp != 'default.png') {
                Storage::delete('/public/images/dp/'.auth()->user()->dp);
            }

            $imgName = Str::random(4).time().'.'.'png';

            $encodedImg = substr($req->dp, strpos($req->dp, ',') + 1);

            Storage::disk('public')->put('images/dp/'.$imgName, base64_decode($encodedImg));

            auth()->user()->update(['dp' => $imgName]);

            return 200;
        }





        
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
