<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $poblacion = District::where('name', 'Poblacion')->firstOrFail();
        $myFeatureIds = Feature::whereIn('name', ['Suki ni Civiles', 'Budget Meal'])->pluck('id');

        $myEatery = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => 'Carinderia ni Civiles',
            'slug' => Str::slug('Carinderia ni Civiles'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $myEatery->features()->sync($myFeatureIds);

        $myEatery->permit()->create([
            'permit_no' => 'DVO-2026-0915',
            'expires_on' => '2027-09-15',
        ]);

        $myEatery->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00, 'is_bestseller' => false],
            ['name' => 'Durian Shake', 'price' => 75.00, 'is_bestseller' => false],
        ]);

        $openEateries = Eatery::factory(11)->create();
        $closedEateries = Eatery::factory(3)->closed()->create();
        $factoryEateries = $openEateries->concat($closedEateries);

        $allFeatureIds = Feature::pluck('id');

        foreach ($factoryEateries as $index => $eatery) {
            Permit::factory()->create([
                'eatery_id' => $eatery->id,
                'expires_on' => $index === 0
                    ? now()->subMonths(2)->toDateString()
                    : fake()->dateTimeBetween('+2 months', '+2 years')->format('Y-m-d'),
            ]);

            Dish::factory(rand(2, 5))->create([
                'eatery_id' => $eatery->id,
            ]);

            $randomFeatures = $allFeatureIds->random(rand(1, 3))->all();
            $eatery->features()->attach($randomFeatures);
        }
    }
}