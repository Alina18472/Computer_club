<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tariff;
use App\Models\Computer;
use App\Models\ComputerSpec;
use App\Models\ComputerPosition;
use App\Models\Food;
use App\Models\Code;
use App\Models\Booking;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        Booking::factory(25)->create();

        Club::factory(25)->create();

        Code::factory(10)->create();

        ComputerSpec::factory(25)->create();

        ComputerPosition::factory(25)->create();

        Computer::factory(25)->create();

        Food::factory(20)->create();

        Payment::factory(25)->create();

        Tariff::factory(20)->create();

    }
}
