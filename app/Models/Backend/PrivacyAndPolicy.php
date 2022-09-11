<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PrivacyAndPolicy extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['privacy_policy','term'];

}
