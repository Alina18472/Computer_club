<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerPositionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'number' => $this->faker->numberBetween(1, 20),
            'coefficient' => $this->faker->numberBetween(1, 100),
            'club_id' => Club::factory(),
        ];
    }
}
