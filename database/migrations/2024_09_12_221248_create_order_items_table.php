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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // 注文明細ID
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // 注文ID
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // 商品ID
            $table->integer('quantity'); // 商品数量
            $table->decimal('price', 10, 2); // 商品単価
            $table->timestamps(); // 作成日、更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
