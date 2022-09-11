<?php

namespace App\Models\Backend;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory,HasTranslations,Sluggable,SearchableTrait;

    protected $guarded = [];


    public $translatable = ['title', 'content'];


    protected $searchable = [

        'columns' => [
            'posts.title' => 10,
            'posts.title_ar' => 10,
            'posts.content' => 10,

        ],

    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $dates = [

        'date_of_publication'
    ];

    public function date_of_publication_status()
    {


                $this->update([

                    'status' => true
                ]);

    }

    public function scopeActive($query){

        return $query->whereStatus(true);
    }

    public function status(){

        return $this->status == 1 ? trans('posts.Active') :  trans('posts.InActive');

    }

    public  function  firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class,'mediable')->orderBy('file_sort','asc');

    }
    public function media(): MorphMany
    {

        return $this->morphMany(Media::class,'mediable');
    }
}
