<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function GetAuthName(Request $req)
    {
        return Auth()->user()->name;
    }

    public function GetAuthEmail(Request $req)
    {
        return Auth()->user()->email;
    }

    public function GetAuthMobile(Request $req)
    {
        return Auth()->user()->mobile;
    }
}
