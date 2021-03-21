<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\AffiliateOrderItem;
use App\Models\AffiliateWalletTxn;
use App\Models\User;
use App\Mail\AffiliateComissionCreditedMail;
use Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AffiliateController extends Controller
{

    public function Index()
    {
        if (Auth()->user()->can('Affiliate')) {
            return redirect()->route('affiliate.referred-purchases');
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

    public function ReferredPurchasesPage()
    {
        if (Auth()->user()->can('Affiliate')) {
            return view('affiliate.referred-purchases');
        } 
        else {
           return $this->Index();
        }
    }

    public function SettingsPage()
    {
        return view('affiliate.settings');
    }

    public function ReportsPage()
    {
        return view('affiliate.reports');
    }





}
