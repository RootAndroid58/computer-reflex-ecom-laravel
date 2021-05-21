<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

use App\Models\SessionCart;
use App\Models\Cart;
use App\Models\SessionCompare;
use App\Models\Compare;

use Session;
use URL;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Sync Affiliate with Cloud while Login
        $aff = request()->session()->get('aff');
        if (isset($aff)) {
            $associate = User::where('id', request()->session()->get('aff'))->first();
            if (isset($associate)) {
                if($associate->can('Affiliate')){
                    
                    $sameAff    = Affiliate::where('associate_id', request()->aff)->where('user_id', Auth()->user()->id)->first();
                    $Aff        = Affiliate::where('user_id', Auth()->user()->id)->first();
                
                    if (!isset($Aff)) {
                        $Affiliate                  = new Affiliate;
                        $Affiliate->user_id         = Auth()->user()->id;
                        $Affiliate->associate_id    = request()->aff;
                        $Affiliate->exp_date        = date_create(date('y-m-d h:m:s', strtotime ('+30 day')));
                        $Affiliate->save();
                    }
            
                    if (isset($Aff) && !isset($sameAff)) {
                        Affiliate::where('id', $Aff->id)->update([
                            'associate_id'  => request()->aff,
                            'exp_date'      => date_create(date('y-m-d h:m:s', strtotime ('+30 day'))),
                        ]);
                    }
                }
            }
        }

        // Sync Cart with Cloud while Login
        $SessionCart = SessionCart::where('session_id', request()->cookie('computer_reflex_session'));

        if ($SessionCart->get()->count() > 0) {

            foreach ($SessionCart->get() as $data) {
                $CloudCart = Cart::where('user_id', Auth()->user()->id)->where('product_id', $data->product_id)->first();
                if (!isset($CloudCart)) {
                    $cart = new Cart;
                    $cart->user_id = Auth()->user()->id;
                    $cart->product_id = $data->product_id;
                    $cart->qty = $data->qty;
                    $cart->save();
                }
            }

            $SessionCart->delete();
        }
        
        
        // Sync Compare with Cloud while Login
        $SessionCompare = SessionCompare::where('session_id', request()->cookie('computer_reflex_session'));

        if ($SessionCompare->get()->count() > 0) {
            foreach ($SessionCompare->get() as $data) {
                $CloudCompare = Compare::where('user_id', Auth()->user()->id)->where('product_id', $data->product_id)->first();
                if (!isset($CloudCompare)) {
                    $Compare = new Compare;
                    $Compare->user_id = Auth()->user()->id;
                    $Compare->product_id = $data->product_id;
                    $Compare->save();
                }
            }

            $SessionCompare->delete();
        }
    }
}
