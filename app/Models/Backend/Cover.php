<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Cover extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = ['field_one', 'field_tow','field_three'];

}
