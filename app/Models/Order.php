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
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
