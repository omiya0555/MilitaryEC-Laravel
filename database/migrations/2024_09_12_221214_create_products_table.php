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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //商品名
            $table->text('description')->nullable(); // 商品説明
            $table->decimal('price', 10, 2); // 価格
            $table->integer('stock_quantity'); // 在庫数
            $table->string('image_path')->nullable(); // 画像パス
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // カテゴリID
            $table->timestamps(); // 作成日、更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
