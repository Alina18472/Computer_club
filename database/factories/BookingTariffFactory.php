<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingTariff;
use App\Models\Club;
use App\Models\User;
use App\Models\Computer;
use App\Models\Tariff;
use App\Models\Code;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingTariffFactory extends Factory
{
    protected $model = BookingTariff::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $minutes = $this->faker->numberBetween(30, 240);
        $end = (clone $start)->modify("+$minutes minutes");

        return [
            'booking_id' => Booking::factory(),
            'tariff_id' => Tariff::factory(),
            'start_time' => $start,
            'end_time' => $end,
            'price' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
