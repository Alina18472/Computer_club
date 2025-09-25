<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'payment_type' => $this->faker->randomElement(['credit_card', 'paypal', 'crypto']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'payment_date' => $this->faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s'),
            'payment_hash' => $this->faker->optional()->sha256,
        ];
    }
}
