<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Models\User;
use Auth;

class AffCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Affiliate::where('exp_date', '<', date_create(date('y-m-d h:m:s')))->delete();

        if (isset($request->aff)) {
            $associate  = User::where('id', $request->aff)->first();

            if (isset($associate) && !Auth::check()) 
            {
                if($associate->can('Affiliate')){
                    $request->session()->put('aff', $request->aff);
                    $request->session()->save();
                }
            } 
            else 
            {
                $sameAff    = Affiliate::where('associate_id', $request->aff)->where('user_id', Auth()->user()->id)->first();
                $Aff        = Affiliate::where('user_id', Auth()->user()->id)->first();
                
                if (isset($associate)) {
                    if ($associate->can('Affiliate')) {
    
                        if (!isset($Aff)) {
                            $Affiliate                  = new Affiliate;
                            $Affiliate->user_id         = Auth()->user()->id;
                            $Affiliate->associate_id    = $request->aff;
                            $Affiliate->exp_date        = date_create(date('y-m-d h:m:s', strtotime ('+30 day')));
                            $Affiliate->save();
                        }
                
                        if (isset($Aff) && !isset($sameAff)) {
                            Affiliate::where('id', $Aff->id)->update([
                                'associate_id'  => $request->aff,
                                'exp_date'      => date_create(date('y-m-d h:m:s', strtotime ('+30 day'))),
                            ]);
                        }
    
                    }
                }
            }


        }
        

        return $next($request);
    }
}
