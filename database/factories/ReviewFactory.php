<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trip;
use App\Models\Restaurant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            // 'reviewable_id' => Trip::factory(),
            // 'reviewable_type' => function (array $attributes) {
            //     return Trip::find($attributes['reviewable_id'])->getMorphClass();
            // },
            // 'review' =>  fake()->text(),
            'reviewable_id' => Restaurant::factory(),
            'reviewable_type' => function (array $attributes) {
                return Restaurant::find($attributes['reviewable_id'])->getMorphClass();
            },
            'review' =>  fake()->text(),
        ];
    }
}
