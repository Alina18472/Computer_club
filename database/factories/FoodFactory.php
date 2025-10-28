<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    protected $model = Food::class;

    public function definition(): array
    {
        return [
            'name'  => $this->faker->word(),
            'type'  => $this->faker->randomElement(['drink', 'snack']),
            'price' => $this->faker->randomFloat(2, 50, 300),
            'count' => $this->faker->numberBetween(1, 20),
            "path_to_img" => $this->faker->imageUrl(),
            'club_id' => Club::factory(),
        ];
    }
}
