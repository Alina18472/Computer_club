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
            'number' => 1,
            'room_id' => Room::factory(),
            'coefficient' => $this->faker->randomFloat(2, 1.0, 1.5),
            'position_x' => $this->faker->numberBetween(1, 10),
            'position_y' => $this->faker->numberBetween(1, 10),
            'club_id' => Club::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($position) {
            $position->update(['number' => $position->id]);
        });
    }
}
