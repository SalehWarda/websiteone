<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = ['name', 'degree','bio','education','experiences','goals','address'];



}
