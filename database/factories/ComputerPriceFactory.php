<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComputerPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Эконом', 'Стандарт', 'Премиум', 'Геймерский', 'Профессиональный']),
            'price_per_hour' => $this->faker->randomFloat(500, 800, 1200),
        ];
    }
}
