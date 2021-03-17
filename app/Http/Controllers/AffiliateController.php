<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AffiliateController extends Controller
{

    public function Index()
    {
        if (Auth()->user()->can('Affiliate')) {
            return redirect()->route('affiliate.dashboard');
        } 
        else 
        {
            return redirect()->route('affiliate.join');
        }
    }
    
    public function ShowJoinPage()
    {
        if (Auth()->user()->can('Affiliate')) {
            return $this->Index();
        } 
        else {
            return view('affiliate.join');
        }
    }

    public function JoinSubmit(Request $req)
    {
        // Permission::create(['name' => 'Affiliate']);
        if (Auth()->user()->can('Affiliate')) {
            return $this->Index();
        } else {
            Auth()->user()->givePermissionTo('Affiliate');
        }
    }   

    public function ShowDashboardPage()
    {
        if (Auth()->user()->can('Affiliate')) {
            return view('affiliate.dashboard');
        } 
        else {
           return $this->Index();
        }
    }



}
