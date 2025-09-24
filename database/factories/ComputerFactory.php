<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(1000, 5000),
            'spec_id' => \App\Models\ComputerSpec::factory(),
            'position_id' => \App\Models\ComputerPosition::factory(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
