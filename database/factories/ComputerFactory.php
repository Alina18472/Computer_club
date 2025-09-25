<?php

namespace Database\Factories;

use App\Models\ComputerPosition;
use App\Models\ComputerSpec;
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
            'spec_id' =>ComputerSpec::factory(),
            'position_id' => ComputerPosition::factory(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
