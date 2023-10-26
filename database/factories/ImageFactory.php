<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trip;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'imageable_id' => Trip::factory(),
            'imageable_type' => function (array $attributes) {
                return Trip::find($attributes['imageable_id'])->getMorphClass();
            },
            'image' => $this->faker->image(public_path('images/trips/trip_images'),400,300, null, false) ,


        ];
    }
}
