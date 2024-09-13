<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'ギア', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アパレル', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アクセサリー', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
