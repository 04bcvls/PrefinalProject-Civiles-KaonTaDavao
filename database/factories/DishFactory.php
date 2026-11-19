<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    public function definition(): array
    {
        $dishes = [
            'Tinolang Manok',
            'Kinilaw na Tuna',
            'Sinugbang Baboy',
            'Pinakbet',
            'Adobong Pusit',
            'Pancit Canton',
            'Bicol Express',
            'Ginataang Langka',
            'Lumpia Shanghai',
            'Leche Flan',
        ];

        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement($dishes),
            'price' => fake()->randomFloat(2, 45, 250),
            'is_bestseller' => fake()->boolean(25),
        ];
    }
}