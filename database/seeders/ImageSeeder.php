<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Image;
use \App\Models\Trip;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Image::factory()->count(5)->create();
        Trip::all()->each(function (Trip $trip) {
            Image::factory()->count(5)->create([
                'imageable_id' => $trip->id,
                'imageable_type' => Trip::class,
            ]);
        });
    


    }
}
