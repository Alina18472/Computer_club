<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
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
            'price_id' => \App\Models\ComputerPrice::factory(),
            'spec_id' => \App\Models\ComputerSpecs::factory(),
            'position_id' => \App\Models\ComputerPosition::factory(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
