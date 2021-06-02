<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compare;
use App\Models\Specification;
use App\Models\SessionCompare;
use Session;
use Auth;


class CompareController extends Controller
{
    public function ShowCompare()
    {
        if (Auth::check()) {
            $compare = Compare::with('product.specifications')->with('product.images')->where('user_id', Auth()->user()->id)->get();
        } else {
            $compare = SessionCompare::with('product.specifications')->with('product.images')->where('session_id', Session::getId())->get();
        }

        $product_ids = $compare->pluck('product_id');

        $specifications = Specification::whereIn('product_id', $product_ids)
        ->groupBy('specification_key') // group by query
        ->get();

        return view('compare', [
            'compare'           => $compare,
            'specifications'    => $specifications,
            'product_ids'       => $product_ids,
        ]);
    }

    static function ToggleCompare(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        if (Auth::check()) {
            $compareCheck = Compare::where('user_id', Auth()->user()->id)->where('product_id', $req->product_id)->first();
        } else {
            $compareCheck = SessionCompare::where('session_id', Session::getId())->where('product_id', $req->product_id)->first();
        }
        
        if (isset($compareCheck)) {
            $compareCheck->delete();
            $status = 500;
            $type = 'danger';
            $msg = 'Removed From Comparison.';
        } else {
            if (Auth::check()) {
                $compare = new Compare;
                $compare->user_id = Auth()->user()->id;
            } else {
                $compare = new SessionCompare;
                $compare->session_id = Session::getId();
            }
            $compare->product_id = $req->product_id;
            $compare->save();
            $status = 200;
            $type = 'success';
            $msg = 'Added To Comparison.';
        }

        if (Auth::check()) {
            $compareCount = Compare::where('user_id', Auth()->user()->id)->get();
         } else {
             $compareCount = SessionCompare::where('session_id', Session::getId())->get();
         }

        return [
            'product_id'    => $req->product_id,
            'status'        => $status,
            'type'          => $type,
            'msg'           => $msg,
            'compareCount'  => $compareCount->count(),
        ];
    }
}
