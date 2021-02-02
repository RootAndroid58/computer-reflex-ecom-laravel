<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function ShowAccount(Request $req)
    {
        return view('account');
    }

    public function UpdateName(Request $req)
    {
        $req->validate([
            'new_name' => 'required',
        ]);

        Auth()->user()->update([
            'name' => $req->new_name,
        ]);

        return Auth()->user()->name;

    }

    public function UpdateEmail(Request $req)
    {
        $req->validate([
            'new_email' => 'required|email',
        ]);

        Auth()->user()->update([
            'email' => $req->new_email,
        ]);

        return Auth()->user()->email;

    }

    public function UpdateMobile(Request $req)
    {
        $req->validate([
            'new_mobile' => 'required|numeric',
        ]);

        Auth()->user()->update([
            'mobile' => $req->new_mobile,
        ]);

        return Auth()->user()->mobile;

    }
}
