<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'タクティカルバックパック',
                'description' => 'アウトドアに最適な丈夫で耐久性のあるバックパック。',
                'price' => 12000,
                'stock_quantity' => 15,
                'image_path' => 'back.jpg', 
                'category_id' => 1, // カテゴリIDは事前に作成しておく
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ミリタリーブーツ',
                'description' => '長時間使用に耐える高品質なミリタリーブーツ。',
                'price' => 8500,
                'stock_quantity' => 30,
                'image_path' => 'boots.jpg', 
                'category_id' => 1, // カテゴリIDは事前に作成しておく
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'カモフラージュジャケット',
                'description' => '快適で軽量なカモフラージュジャケット。',
                'price' => 6500,
                'stock_quantity' => 20,
                'image_path' => 'jacket.png', 
                'category_id' => 2, // カテゴリIDは事前に作成しておく
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'フラッシュライト',
                'description' => '明るく信頼性の高いフラッシュライト。',
                'price' => 4500,
                'stock_quantity' => 50,
                'image_path' => 'light.png', 
                'category_id' => 3, // カテゴリIDは事前に作成しておく
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
