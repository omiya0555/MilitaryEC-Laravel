<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            'user_id' => 1,  // ユーザーID 1 に紐づく住所
            'postal_code' => '100-0001',  // 郵便番号（東京都千代田区）
            'prefecture' => '東京都',     
            'city' => '千代田区',      
            'street_address' => '千代田1-1', 
            'building' => '皇居前ビル',     
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
