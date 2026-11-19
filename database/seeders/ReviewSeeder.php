<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $myEatery = Eatery::where('slug', 'carinderia-ni-civiles')->firstOrFail();
        $tita = User::where('email', 'tita.civiles@kaonta.test')->firstOrFail();
        $otherUsers = User::where('id', '!=', $tita->id)->get();

        $myEatery->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Civiles.',
        ]);

        foreach ($otherUsers->random(3) as $user) {
            Review::factory()->create([
                'eatery_id' => $myEatery->id,
                'user_id' => $user->id,
            ]);
        }

        $openFactoryEateries = Eatery::where('is_open', true)
            ->where('id', '!=', $myEatery->id)
            ->get();

        foreach ($openFactoryEateries as $eatery) {
            $count = rand(0, 6);
            if ($count > 0) {
                Review::factory($count)->create([
                    'eatery_id' => $eatery->id,
                ]);
            }
        }
    }
}