<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\StoreAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantStoreValue>
 */
class MerchantStoreValueFactory extends Factory
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
            'store_attribute_id' => StoreAttribute::all()->random()->id,
            'value' => $this->faker->word
        ];
    }
}
