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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // カートID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // 商品ID
            $table->integer('quantity'); // 商品数量
            $table->decimal('total_amount', 10, 0)->default(0); // 合計金額
            $table->timestamps(); // 作成日、更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
