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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 外部キー　ユーザーID
            $table->string('postal_code');  // 郵便番号
            $table->string('prefecture');   // 都道府県
            $table->string('city');         // 市区町村
            $table->string('street_address'); // 住所
            $table->string('building')->nullable(); // 建物名（任意）
            $table->timestamps(); // 作成・更新時刻
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
