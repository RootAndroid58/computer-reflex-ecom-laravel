<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductQuestion;
use App\Models\ProductAnswer;
use Auth;

class ProductQNAController extends Controller
{
    public function QuestionSubmit(Request $req)
    {
        if (!Auth::check()) {
            return [
                'status' => 500,
            ];
        }
        
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
        if (!Auth::check()) {
            return [
                'status' => 500,
            ];
        }

        $question = ProductQuestion::where('id', $req->question_id)->first();
        $pid = $question->product_id;
        $answerable = Order::where('user_id', Auth()->user()->id)
        ->whereHas('OrderItems', function ($query) use ($pid) {
            $query->where('product_id', $pid);
        })->first();

        if (isset($question) && isset($answerable)) {
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
