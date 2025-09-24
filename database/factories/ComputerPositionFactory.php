<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerPositionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room' => $this->faker->randomElement(['Room A', 'Room B', 'Room C']),
            'number' => $this->faker->numberBetween(1, 20),
        ];
    }
}
