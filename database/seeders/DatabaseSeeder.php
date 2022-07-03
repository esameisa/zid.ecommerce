<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // user seeder
        $this->call([
            UserSeeder::class,
            StoreAttributeSeeder::class,
            StoreSeeder::class,
            MerchantStoreValueSeeder::class
        ]);
    }
}
