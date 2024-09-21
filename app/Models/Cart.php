<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //fillableを定義
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'postal_code',
        'prefecture',
        'city',
        'street_address',
        'building',
    ];

    //cartに関連するproducts
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //cartに関連するユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
