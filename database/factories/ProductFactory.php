<?php

namespace Database\Factories;

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
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'content' => $this->faker->text,
            'category_id' => $this->faker->numberBetween(1, 9),
            'price' => $this->faker->numberBetween(100000, 100000000),
            'price_sale' => $this->faker->numberBetween(100000, 10000000),
            'active' => 1,
            'thumb' => $this->faker->imageUrl(400, 400),
        ];
    }
}
