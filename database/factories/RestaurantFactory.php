<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'email' => $this->faker->unique()->safeEmail,
            'street' => $this->faker->streetAddress,
            'government' => $this->faker->city,
            'description' => $this->faker->text,
            'phone' => $this->faker->phoneNumber,
            'thumbnail' => $this->faker->image(public_path('images/restaurants'), 400, 300, null, false),
            'creator_id' => 1, // Assuming you have a user with ID 1 as the creator
        ];
    }
}

