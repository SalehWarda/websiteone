<?php

namespace App\Models\Backend;

use App\Models\Order;
use App\Models\User;
use App\Models\UserServiceDate;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasFactory,HasTranslations,Sluggable,SearchableTrait;

    protected $guarded = [];

    public $translatable = ['title', 'description'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $searchable = [

        'columns' => [
            'courses.title' => 10,
            'courses.title_ar' => 10,

//            'services.description' => 10,
//            'services.status' => 10,

        ],

    ];
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_course');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function scopeActive($query){

        return $query->whereStatus(true);
    }

    public function status(){

        return $this->status == 1 ? trans('courses.Active') : trans('courses.InActive');

    }

    public  function  firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class,'mediable');

    }


    public function videos()
    {
        return $this->hasMany(Video::class,'course_id','id');
    }



}
