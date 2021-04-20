<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ProductAnswer;

use Nicolaslopezj\Searchable\SearchableTrait;

class ProductQuestion extends Model
{
    use HasFactory, SearchableTrait;

    protected $searchable = [
        /**
         * Searchable rules.
         *
         * @var array
         */
    
    
            /**
             * Columns and their priority in search results.
             * Columns with higher values are more important.
             * Columns with equal values have equal importance.
             *
             * @var array
             */
            'groupBy'=> ['product_questions.id'],
    
            'columns' => [
                'product_questions.question' => 10,
                'product_answers.answer' => 10,
            ],
            'joins' => [
                'product_answers'      => ['product_answers.question_id', 'product_questions.id'],
            ],
        ];

        public function answers()
        {
            return $this->hasMany(ProductAnswer::class, 'question_id', 'id')->orderBy('id', 'desc');
        }
        public function user()
        {
            return $this->hasOne(User::class, 'id', 'user_id');
        }
}
