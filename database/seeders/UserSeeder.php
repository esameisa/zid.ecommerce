<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'merchant',
            'email' => 'merchant@zid.sa',
            'type' => 'merchant',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'consumer',
            'email' => 'consumer@zid.sa',
            'type' => 'consumer',
        ]);

        \App\Models\User::factory(5)->create();
    }
}
