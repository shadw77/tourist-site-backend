<?php

namespace Database\Factories;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    protected $model = Trip::class;
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
            'duration' => fake()->text(),
            'cost' => fake()->text(),
            'description' => fake()->text(),
            'rating' => fake()->text(),
            'thumbnail' => $this->faker->image(public_path('images/trips'),400,300, null, false) ,
            'creator_id' => 1,
        ];
    }
}
