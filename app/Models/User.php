<?php

namespace App\Models;

use App\Models\Backend\Course;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile',
        'user_image',
        'status',
        'password',
    ];

    protected $appends=['full_name'];


    public function getFullNameAttribute(): string
    {
        return Str::substr($this->first_name,0,1)  . ' ' . Str::substr($this->last_name,0,1);
    }

    public function getFullNameeAttribute(): string
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function status(): string
    {
        return $this->status ? trans('users.Active') : trans('users.InActive');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dateService()
    {
        return $this->hasOne(UserServiceDate::class,'user_id');
    }
}
