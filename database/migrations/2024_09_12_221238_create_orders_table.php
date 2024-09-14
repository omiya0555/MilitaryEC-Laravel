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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // 注文ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID
            $table->decimal('total_amount', 10, 0); // 合計金額
            $table->text('shipping_address')->nullable(); // 配送先住所
            $table->string('status')->default('pending'); // 注文ステータス
            $table->timestamps(); // 作成日、更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
