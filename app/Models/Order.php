<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //fillableを定義
    protected $fillable = [
        'user_id',
        'total_amount',
        'postal_code',
        'prefecture',
        'city',
        'street_address',
        'building',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
