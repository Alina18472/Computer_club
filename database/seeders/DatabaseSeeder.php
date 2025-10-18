<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Club,
    Room,
    User,
    Tariff,
    Computer,
    ComputerSpec,
    ComputerPosition,
    Food,
    Code,
    Booking,
    Payment
};
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::factory(3)->create();

        foreach ($clubs as $club) {
            foreach (['Room A', 'Room B', 'Room C'] as $name) {
                Room::factory()->create([
                    'club_id' => $club->id,
                    'name' => $name,
                ]);
            }
        }

        $users = [
            [
                'name' => 'User One',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'money' => 500.00,
            ],
            [
                'name' => 'Admin One',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'money' => 1000.00,
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'money' => 2000.00,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        $tariffs = [
            ['name' => 'Дневной', 'coefficient' => 1.0],
            ['name' => 'Вечерний', 'coefficient' => 1.2],
            ['name' => 'Ночной', 'coefficient' => 0.8],
        ];

        foreach ($tariffs as $tariff) {
            Tariff::create($tariff);
        }

        foreach ($clubs as $club) {
            for ($i = 1; $i <= 10; $i++) {
                $room = $club->rooms()->inRandomOrder()->first();
                ComputerPosition::factory()->create([
                    'number' => $i,
                    'coefficient' => fake()->randomFloat(2, 1.0, 1.5),
                    'club_id' => $club->id,
                    'room_id' => $room->id,
                ]);
            }
        }

        $specs = ComputerSpec::factory(10)->create();

        $positions = ComputerPosition::all();
        for ($i = 0; $i < 30; $i++) {
            Computer::factory()->create([
                'spec_id' => $specs->random()->id,
                'position_id' => $positions->random()->id,
                'price' => fake()->randomFloat(2, 50, 300),
            ]);
        }

        Food::factory(10)->create();

        Code::factory(5)->create();

        $computers = Computer::all();
        $tariffs = Tariff::all();
        $clubs = Club::all();

        foreach (User::all() as $user) {
            for ($i = 0; $i < 5; $i++) {
                $computer = $computers->random();
                $club = $clubs->random();
                $tariff = $tariffs->random();

                $start = now()->subDays(rand(1, 10))->setTime(rand(10, 22), 0);
                $end = (clone $start)->addHours(rand(1, 4));

                $booking = Booking::create([
                    'computer_id' => $computer->id,
                    'user_id' => $user->id,
                    'tariff_id' => $tariff->id,
                    'code_id' => null,
                    'club_id' => $club->id,
                    'start_time' => $start,
                    'end_time' => $end,
                    'minutes' => $start->diffInMinutes($end),
                    'price_for_pc' => fake()->randomFloat(2, 100, 300),
                    'price_for_additions' => fake()->randomFloat(2, 10, 50),
                    'total_price' => fake()->randomFloat(2, 150, 350),
                    'status' => 'confirmed',
                ]);

                Payment::create([
                    'user_id' => $user->id,
                    'payment_type' => 'card',
                    'status' => 'completed',
                    'payment_date' => now()->toDateString(),
                    'payment_hash' => fake()->sha256(),
                    'price' => $booking->total_price,
                ]);
            }
        }
    }
}
