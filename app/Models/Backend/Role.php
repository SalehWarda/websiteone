<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','permissions'
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function getPermissionsAttribute($permissions)
    {
      return json_decode($permissions, true);
    }
}
