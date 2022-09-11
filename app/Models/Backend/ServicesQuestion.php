<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class ServicesQuestion extends Model
{
    use HasFactory,HasTranslations,SearchableTrait;

    protected $guarded = [];

    public  $translatable = ['question', 'answer'];


    protected $searchable = [

        'columns' => [
            'services_questions.question' => 10,
            'services_questions.answer' => 10,

        ],

    ];

    public function sort(){

        if ($this->sort == 'input'){

            return trans('services.Input');

        }else{

            return trans('services.File');
        }

    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
     public function answer()
     {
         return $this->hasOne(Answer::class,'services_questions_id');
     }
}
