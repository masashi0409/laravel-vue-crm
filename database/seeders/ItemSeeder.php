<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('items')->insert([
                [
                    'name' => 'カット',
                    'memo' => 'カットの詳細',
                    'price' => 6000,
                    'is_selling' => true
                ],
                [
                    'name' => 'カラー',
                    'memo' => 'カラーの詳細',
                    'price' => 8000,
                    'is_selling' => true
                ],
                [
                    'name' => 'パーマ(カット込)',
                    'memo' => 'パーマ、カットの詳細',
                    'price' => 13000,
                    'is_selling' => true
                ]
            ]);
        }
    }
}