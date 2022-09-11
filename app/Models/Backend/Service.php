<?php

namespace App\Models\Backend;

use App\Models\Order;
use App\Models\UserServiceDate;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory,HasTranslations,Sluggable,SearchableTrait;

    protected $guarded = [];

    public $translatable = ['name', 'description'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [

        'columns' => [
            'services.name' => 10,
            'services.name_ar' => 10,
//            'services.status' => 10,

        ],

    ];

    public function scopeActive($query){

        return $query->whereStatus(true);
    }

    public function status(){

        if ($this->status == 'open'){

            return trans('services.Open');

        }elseif ($this->status == 'closed'){

            return trans('services.Closed');
        }else{

            return trans('services.futuristic ');
        }

    }

    public  function  firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class,'mediable')->orderBy('file_sort','asc');

    }
    public function media(): MorphMany
    {

        return $this->morphMany(Media::class,'mediable');
    }

    public function questions()
    {
        return $this->hasMany(ServicesQuestion::class,'service_id','id');
    }

    public function serviceTimings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ServiceTiming::class,'service_id');
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function dateService()
    {
        return $this->hasOne(UserServiceDate::class,'service_id');
    }
}
