<?php

namespace App\Models;

use App\Models\Backend\Service;
use App\Models\Backend\ServiceTiming;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServiceDate extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function serviceTiming()
    {
        return $this->belongsTo(ServiceTiming::class,'service_timings_id');
    }
}
