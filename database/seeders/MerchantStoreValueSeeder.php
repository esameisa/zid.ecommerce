<?php

namespace Database\Seeders;

use App\Models\MerchantStoreValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantStoreValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MerchantStoreValue::factory(15)->create();
    }
}
