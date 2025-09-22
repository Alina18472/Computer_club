<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TarifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tarifTypes = [
            [
                'name' => 'Ночной',
                'from' => '00:00:00',
                'to' => '08:00:00',
                'coefficient' => 1.5,
                'description' =>'Наценка в ночное время'
            ],
            [
                'name' => 'Дневной',
                'from' => '08:00:00',
                'to' => '18:00:00',
                'coefficient' => 1.0,
                'description' => 'Стандартный тариф'
            ],
            [
                'name' => 'Вечерний',
                'from' => '18:00:00',
                'to' => '00:00:00',
                'coefficient' => 1.2,
                'description' => 'Наценка в вечернее время'
            ]
        ];

        $tarif = $this->faker->randomElement($tarifTypes);

        return [
            'from' => $tarif['from'],
            'to' => $tarif['to'],
            'name' => $tarif['name'],
            'coefficient' => $tarif['coefficient'],
            'description' => $tarif['description'],
        ];
    }
}
