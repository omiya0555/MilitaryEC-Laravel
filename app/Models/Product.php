<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //fillableを定義
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_path',
        'category_id',
    ];
}
