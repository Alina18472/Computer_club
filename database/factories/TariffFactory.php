<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tariffTypes = [
            [
                'name' => 'Ночной',
                'coefficient' => 1.5,
            ],
            [
                'name' => 'Дневной',
                'coefficient' => 1.0,
            ],
            [
                'name' => 'Вечерний',
                'coefficient' => 1.2,
            ]
        ];

        $tariff = $this->faker->randomElement($tariffTypes);

        return [
            'name' => $tariff['name'],
            'coefficient' => $tariff['coefficient'],
        ];
    }
}
