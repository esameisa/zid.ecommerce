<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_id' => Store::all()->random()->id,
            'name' => $this->faker->word,
            'vat_type' => $this->faker->randomElement(['included', 'calculated']),
            'vat_percentage' => $this->faker->numberBetween(0, 100),
            'shipping_cost' => $this->faker->numberBetween(10, 200),
        ];
    }
}
