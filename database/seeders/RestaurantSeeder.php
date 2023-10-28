<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Image;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(2)
            ->has(
                Restaurant::factory()
                    ->count(2)
                    ->has(
                        Image::factory()
                            ->count(3),
                        'images'
                    )
                    ->has(
                        Review::factory()
                            ->count(3),
                        'reviews'
                    )
            )
            ->create();
    }
}
