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
    }
}
