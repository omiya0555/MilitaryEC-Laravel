<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // カートアイテムID
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // カートID
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // 商品ID
            $table->integer('quantity'); // 商品数量
            $table->timestamps(); // 作成日、更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
