<?php

namespace App\Models\Backend;

use App\Models\UserServiceDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTiming extends Model
{
    use HasFactory;

    protected $guarded=[];

    public $timestamps=['service_timings_from','service_timings_to'];


    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function dateService()
    {
        return $this->hasOne(UserServiceDate::class,'service_timings_id');
    }
}
