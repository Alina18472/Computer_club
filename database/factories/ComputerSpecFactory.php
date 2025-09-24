<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerSpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ram' => $this->faker->randomElement(['16GB DDR4', '32GB DDR4', '64GB DDR5']),
            'processor' => $this->faker->randomElement(['Intel i5', 'Intel i7', 'Intel i9', 'Ryzen 5', 'Ryzen 7']),
            'gpu' => $this->faker->randomElement(['RTX 3060', 'RTX 4070', 'RTX 4080', 'RX 6700 XT']),
            'monitor' => $this->faker->randomElement(['24" 144Hz', '27" 165Hz', '32" 240Hz']),
            'headphones' => $this->faker->randomElement(['HyperX Cloud II', 'Razer Kraken', 'SteelSeries Arctis']),
            'mouse' => $this->faker->randomElement(['Razer DeathAdder', 'Logitech G Pro', 'SteelSeries Rival']),
            'keyboard' => $this->faker->randomElement(['Mechanical RGB', 'Membrane', 'Optical']),
        ];
    }
}
