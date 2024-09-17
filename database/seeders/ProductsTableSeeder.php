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
                'image_path' => 'image/back.jpg',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ミリタリーブーツ',
                'description' => '長時間使用に耐える高品質なミリタリーブーツ。',
                'price' => 8500,
                'stock_quantity' => 30,
                'image_path' => 'image/boots.jpg',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'カモフラージュジャケット',
                'description' => '快適で軽量なカモフラージュジャケット。',
                'price' => 6500,
                'stock_quantity' => 20,
                'image_path' => 'image/jacket.png',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'フラッシュライト',
                'description' => '明るく信頼性の高いフラッシュライト。',
                'price' => 4500,
                'stock_quantity' => 50,
                'image_path' => 'image/light.png',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'コンパス',
                'description' => '高精度なミリタリーコンパス。',
                'price' => 2000,
                'stock_quantity' => 100,
                'image_path' => 'image/compass.png',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'タクティカルベルト',
                'description' => '耐久性のあるマルチファンクションベルト。',
                'price' => 3500,
                'stock_quantity' => 40,
                'image_path' => 'image/belt.png',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ハンティングナイフ',
                'description' => '頑丈で切れ味の鋭いハンティングナイフ。',
                'price' => 7500,
                'stock_quantity' => 25,
                'image_path' => 'image/knife.png',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'バレットプルーフベスト',
                'description' => '高性能な防弾ベスト。',
                'price' => 20000,
                'stock_quantity' => 10,
                'image_path' => 'image/vest.png',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'タクティカルグローブ',
                'description' => '耐久性とグリップ力に優れたグローブ。',
                'price' => 3500,
                'stock_quantity' => 60,
                'image_path' => 'image/gloves.png',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'キャンティーンセット',
                'description' => 'アウトドア用のボトルとカップのセット。',
                'price' => 1800,
                'stock_quantity' => 80,
                'image_path' => 'image/canteen.png',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ミリタリーキャップ',
                'description' => 'シンプルでスタイリッシュなミリタリーキャップ。',
                'price' => 1200,
                'stock_quantity' => 70,
                'image_path' => 'image/cap.png',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'バイノーラルゴーグル',
                'description' => '暗視能力を高めたバイノーラルゴーグル。',
                'price' => 25000,
                'stock_quantity' => 5,
                'image_path' => 'image/goggles.png',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'タクティカルシャツ',
                'description' => '通気性に優れた軽量なタクティカルシャツ。',
                'price' => 5500,
                'stock_quantity' => 25,
                'image_path' => 'image/shirt.png',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ミリタリーウォッチ',
                'description' => '防水で耐衝撃性のあるミリタリーウォッチ。',
                'price' => 15000,
                'stock_quantity' => 20,
                'image_path' => 'image/watch.png',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}