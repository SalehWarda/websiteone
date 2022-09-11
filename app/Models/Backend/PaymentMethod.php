<?php

namespace App\Models\Backend;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentMethod extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'payment_methods.name' => 10,
            'payment_methods.code' => 10,
            'payment_methods.merchant_email' => 10,
            'payment_methods.sandbox_merchant_email' => 10,
        ]
    ];

    public function status()
    {
        return $this->status ? 'مفعل' : 'غير مفعل';
    }

    public function sandbox(): string
    {
        return $this->sandbox ? 'Sandbox' : 'Live';
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
