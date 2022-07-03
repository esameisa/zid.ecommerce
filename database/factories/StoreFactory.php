<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'merchant_id' => $this->faker->randomElement(
                \App\Models\User::where('type', 'merchant')->pluck('id')->toArray()
            ),
            'name' => $this->faker->word,
        ];
    }
}
