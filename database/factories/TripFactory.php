<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
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
            'name' => fake()->name(),
            'government' => fake()->text(),
            'duration' => fake()->randomFloat(2, 1, 100),
            'cost' => fake()->randomFloat(2, 1, 100),
            'description' => fake()->text(),
            'rating' => fake()->randomFloat(2, 1, 100),
            'thumbnail' => $this->faker->image(public_path('images/trips'),400,300, null, false) ,
            'creator_id' => 1,
        ];
    }
}
