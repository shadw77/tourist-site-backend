<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Trip;

use App\Models\Image;

class UserTripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()
        ->count(2)
        ->has(
            Trip::factory()
                ->count(2)
                ->has(
                    Image::factory()
                        ->count(3),
                    'images'
                )
        )
        ->create();
    }
}
