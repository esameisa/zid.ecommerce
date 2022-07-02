<?php

namespace Database\Seeders;

use App\Models\StoreAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store_attributes = [
            [
                'name' => 'name',
                'type' => 'string',
            ],
            [
                'name' => 'email',
                'type' => 'string',
            ],
            [
                'name' => 'phone',
                'type' => 'string',
            ],
            [
                'name' => 'default_vat_on',
                'type' => 'string'
            ]
        ];

        foreach ($store_attributes as $attribute) {
            StoreAttribute::factory()->create($attribute);
        }
    }
}
