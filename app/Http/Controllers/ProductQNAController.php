<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductQuestion;

class ProductQNAController extends Controller
{
    public function QuestionSubmit(Request $req)
    {
        $req->validate([
            'product_id'    => 'required|exists:products,id',
            'question'      => 'required',
        ]);
        
        $ProductQuestion = new ProductQuestion;
        $ProductQuestion->question      = $req->question;
        $ProductQuestion->user_id       = Auth()->user()->id;
        $ProductQuestion->product_id    = $req->product_id;
        $ProductQuestion->save();

        return [
            'status' => 200,
        ];
    }

    
}
