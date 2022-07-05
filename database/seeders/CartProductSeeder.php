<?php

namespace Database\Seeders;

use App\Models\CartProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CartProduct::factory(15)->create();
    }
}
