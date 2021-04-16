<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compare;
use App\Models\Specification;

class CompareController extends Controller
{
    public function ShowCompare()
    {

        $compare = Compare::with('product.specifications')->with('product.images')->where('user_id', Auth()->user()->id)->get();

        $product_ids = $compare->pluck('product_id');

        $specifications = Specification::whereIn('product_id', $product_ids)
        ->groupBy('specification_key') // group by query
        ->get();

        // dd($compare, $specifications);
        return view('compare',[
            'compare'           => $compare,
            'specifications'    => $specifications,
            'product_ids'       => $product_ids,
        ]);
    }

    public function ToggleCompare(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        $compareCheck = Compare::where('user_id', Auth()->user()->id)->where('product_id', $req->product_id)->first();
        if (isset($compareCheck)) {
            $compareCheck->delete();
            $status = 500;
            $type = 'danger';
            $msg = 'Removed From Comparison.';
        } else {
            $compare = new Compare;
            $compare->product_id = $req->product_id;
            $compare->user_id = Auth()->user()->id;
            $compare->save();
            $status = 200;
            $type = 'success';
            $msg = 'Added To Comparison.';
        }

        return [
            'status'    => $status,
            'type'      => $type,
            'msg'       => $msg,
        ];
    }
}
