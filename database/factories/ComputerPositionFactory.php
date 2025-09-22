<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerPositionFactory extends Factory
{
    private $currentNumber = 0;

    public function definition(): array
    {
        $this->currentNumber++;

        // 6 рядов по 5 колонок = 30 мест
        $row = ceil($this->currentNumber / 5); // ряды 1-6
        $column = (($this->currentNumber - 1) % 5) + 1; // колонки 1-5

        return [
            'row' => $row,
            'column' => $column,
            'name' => (string)$this->currentNumber, // Просто номер места: 1, 2, 3... 30
        ];
    }

    public function create($attributes = [], Model|\Illuminate\Database\Eloquent\Model|null $parent = null)
    {
        $this->currentNumber = 0;
        return parent::create($attributes, $parent);
    }
}
