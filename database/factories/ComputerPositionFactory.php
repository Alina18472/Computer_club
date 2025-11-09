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
            'coefficient' => $this->faker->numberBetween(1, 100),
            'position_x' => $this->faker->numberBetween(1, 10),
            'position_y' => $this->faker->numberBetween(1, 10),
            'club_id' => Club::factory(),
        ];
    }
}
