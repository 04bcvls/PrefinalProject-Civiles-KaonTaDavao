<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'permit_no' => fake()->unique()->numerify('DVO-2026-#####'),
            'expires_on' => fake()->dateTimeBetween('+2 months', '+2 years')->format('Y-m-d'),
        ];
    }
}