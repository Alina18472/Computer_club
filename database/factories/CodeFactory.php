<?php

namespace Database\Factories;

use App\Models\Code;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CodeFactory extends Factory
{
    protected $model = Code::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'discount' => $this->faker->numberBetween(5, 30),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
