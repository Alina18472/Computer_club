<?php

namespace Database\Factories;

use App\Models\AdditionalMenu;
use App\Models\Booking;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdditionalMenuFactory extends Factory
{
    protected $model = AdditionalMenu::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'food_id'    => Food::factory(),
        ];
    }
}
