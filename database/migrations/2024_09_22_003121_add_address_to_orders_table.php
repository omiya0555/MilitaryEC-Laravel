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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('postal_code', 10)->nullable()->after('total_amount');  // 郵便番号
            $table->string('prefecture', 100)->nullable()->after('postal_code');   // 都道府県
            $table->string('city', 100)->nullable()->after('prefecture');          // 市区町村
            $table->string('street_address', 255)->nullable()->after('city');      // 住所（番地）
            $table->string('building', 255)->nullable()->after('street_address');  // 建物名・部屋番号
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
