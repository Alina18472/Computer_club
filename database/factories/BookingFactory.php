<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Computer;
use App\Models\Tariff;
use App\Models\Code;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $minutes = $this->faker->numberBetween(30, 240);
        $end = (clone $start)->modify("+$minutes minutes");

        $priceForPC = $this->faker->randomFloat(2, 100, 500);
        $priceForAdditions = $this->faker->randomFloat(2, 10, 100);

        return [
            'computer_id' => Computer::factory(),
            'user_id' => User::factory(),
            'tariff_id' => Tariff::factory(),
            'code_id' => Code::factory(),
            'start_time' => $start,
            'end_time' => $end,
            'minutes' => $minutes,
            'price_for_pc' => $priceForPC,
            'price_for_additions' => $priceForAdditions,
            'total_price' => $priceForPC + $priceForAdditions,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
