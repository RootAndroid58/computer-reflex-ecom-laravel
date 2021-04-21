<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductQuestion;
use App\Models\ProductAnswer;

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

    public function AnswerSubmit(Request $req)
    {
        $question = ProductQuestion::where('id', $req->question_id)->first();

        if (isset($question)) {
            ProductAnswer::updateOrCreate(
                [ 
                    'user_id' => Auth()->user()->id,
                    'question_id' => $req->question_id,
                ],
                [ 
                    'answer' => $req->answer,
                ]
            );

            return [
                'status' => 200,
            ];
        }

    }

    
}
