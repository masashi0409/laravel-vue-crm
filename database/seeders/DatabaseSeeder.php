<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Customer;
use \App\Models\Item;
use \App\Models\Purchase;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class
        ]);
        
        
        // CustomerのSeederはCustomerFactoryを使って作成する
        Customer::factory(100)->create();
        
        /**
         * Purchase 中間テーブルitem_purchaseもダミーデータを登録する
         * リレーション attachを使う
         * 
         */
        $items = Item::all();
        Purchase::factory(1000)->create()
            ->each(function(Purchase $purchase) use ($items) {
                $purchase->items()->attach(
                    $items->random(rand(1,3))->pluck('id')->toArray(), // item_id ランダムで1~3件、pluck: コレクションからidだけ取得
                    [
                        'quantity' => rand(1, 5)
                    ]
                );
            });
            
            // dd($items->random(rand(1,3))); $items->random() コレクションの中から~件ランダムに取得
    }
}
