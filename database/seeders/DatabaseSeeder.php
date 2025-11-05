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

use Carbon\Carbon;

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

        // Создаем позиции для компьютеров
        $allPositions = [];
        foreach ($clubs as $club) {
            $usedPositions = [];

            for ($i = 1; $i <= 10; $i++) {
                $room = $club->rooms()->inRandomOrder()->first();

                do {
                    $x = rand(1, 10);
                    $y = rand(1, 10);
                    $key = "$club->id-$room->id-$x,$y";
                } while (in_array($key, $usedPositions));

                $usedPositions[] = $key;

                $position = ComputerPosition::factory()->create([
                    'number' => $i,
                    'coefficient' => fake()->randomFloat(2, 1.0, 1.5),
                    'club_id' => $club->id,
                    'room_id' => $room->id,
                    'position_x' => $x,
                    'position_y' => $y,
                ]);

                $allPositions[] = $position;
            }
        }

        // Создаем спецификации для компьютеров
        $specs = ComputerSpec::factory(30)->create();

        // Создаем компьютеры - по одному на каждую позицию
        $computers = [];
        foreach ($allPositions as $index => $position) {
            $computers[] = Computer::factory()->create([
                'spec_id' => $specs[$index]->id,
                'position_id' => $position->id,
                'price' => fake()->randomFloat(2, 50, 300),
            ]);
        }

        foreach ($clubs as $club) {
            Food::factory(10)->create([
                'club_id' => $club->id,
            ]);
        }

        Code::factory(5)->create();

        $this->createPositionBookings($computers);
    }

    private function createPositionBookings(array $computers): void
    {
        $users = User::where('role', 'user')->get();
        $tariffs = Tariff::all();

        // Группируем компьютеры по клубам
        $computersByClub = [];
        foreach ($computers as $computer) {
            $clubId = $computer->position->club_id;
            if (!isset($computersByClub[$clubId])) {
                $computersByClub[$clubId] = [];
            }
            $computersByClub[$clubId][] = $computer;
        }

        // Выбираем по 2 компьютера из каждого клуба для бронирования (всего 6)
        $selectedComputers = [];
        foreach ($computersByClub as $clubId => $clubComputers) {
            $selectedFromClub = array_slice($clubComputers, 0, 2);
            $selectedComputers = array_merge($selectedComputers, $selectedFromClub);
        }

        // Даты для бронирования с 2025-11-05 по 2025-11-08
        $dates = [
            '2025-11-05',
            '2025-11-06',
            '2025-11-07',
            '2025-11-08'
        ];

        // Временные промежутки для каждого дня
        $dailyTimeSlots = [
            [
                ['start' => '01:00', 'end' => '04:00'],
                ['start' => '05:00', 'end' => '08:00'],
                ['start' => '09:00', 'end' => '12:00'],
                ['start' => '13:00', 'end' => '16:00'],
                ['start' => '17:00', 'end' => '20:00'],
            ],
            [
                ['start' => '02:00', 'end' => '05:00'],
                ['start' => '06:00', 'end' => '09:00'],
                ['start' => '10:00', 'end' => '13:00'],
                ['start' => '14:00', 'end' => '17:00'],
                ['start' => '18:00', 'end' => '21:00'],
            ],
            [
                ['start' => '03:00', 'end' => '06:00'],
                ['start' => '07:00', 'end' => '10:00'],
                ['start' => '11:00', 'end' => '14:00'],
                ['start' => '15:00', 'end' => '18:00'],
                ['start' => '19:00', 'end' => '22:00'],
            ],
            [
                ['start' => '04:00', 'end' => '07:00'],
                ['start' => '08:00', 'end' => '11:00'],
                ['start' => '12:00', 'end' => '15:00'],
                ['start' => '16:00', 'end' => '19:00'],
                ['start' => '20:00', 'end' => '23:00'],
            ]
        ];

        $totalBookings = 0;

        foreach ($dates as $dateIndex => $date) {
            $timeSlots = $dailyTimeSlots[$dateIndex];

            // Перемешиваем компьютеры для равномерного распределения броней
            shuffle($selectedComputers);

            // Для каждого дня создаем 6-8 бронирований
            $bookingsCount = rand(6, 8);
            $availableSlots = array_slice($timeSlots, 0, $bookingsCount);

            foreach ($availableSlots as $slotIndex => $timeSlot) {
                $user = $users->random();
                // Берем компьютер по кругу для равномерного распределения
                $computer = $selectedComputers[$slotIndex % count($selectedComputers)];
                $tariff = $tariffs->random();

                // Клуб берем из позиции компьютера, а не случайный!
                $clubId = $computer->position->club_id;

                $startTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $timeSlot['start']);
                $endTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $timeSlot['end']);

                $minutes = $startTime->diffInMinutes($endTime);
                $priceForPc = $computer->price * ($minutes / 60) * $tariff->coefficient;
                $priceForAdditions = fake()->randomFloat(2, 10, 50);
                $totalPrice = $priceForPc + $priceForAdditions;

                $booking = Booking::create([
                    'computer_id' => $computer->id,
                    'user_id' => $user->id,
                    'tariff_id' => $tariff->id,
                    'code_id' => null,
                    'club_id' => $clubId, // Используем клуб компьютера, а не случайный
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'minutes' => $minutes,
                    'price_for_pc' => round($priceForPc, 2),
                    'price_for_additions' => $priceForAdditions,
                    'total_price' => round($totalPrice, 2),
                    'status' => 'confirmed',
                ]);

                Payment::create([
                    'user_id' => $user->id,
                    'payment_type' => 'card',
                    'status' => 'completed',
                    'payment_date' => $startTime->toDateString(),
                    'payment_hash' => fake()->sha256(),
                    'price' => $booking->total_price,
                ]);

                $totalBookings++;
                $this->command->info("Created booking for computer {$computer->id} at position {$computer->position_id} in club {$clubId} on {$date} from {$timeSlot['start']} to {$timeSlot['end']}");
            }
        }

        // Статистика по броням для каждого компьютера
        $computerStats = [];
        foreach ($selectedComputers as $computer) {
            $bookingCount = Booking::where('computer_id', $computer->id)->count();
            $clubId = $computer->position->club_id;
            $computerStats[] = "Computer {$computer->id} (club {$clubId}, position {$computer->position_id}): {$bookingCount} bookings";
        }

        $this->command->info("Created {$totalBookings} total bookings for " . count($selectedComputers) . " computers.");
        $this->command->info("Booking statistics by club:");

        // Группируем статистику по клубам
        $statsByClub = [];
        foreach ($computerStats as $stat) {
            $this->command->info("  - {$stat}");
        }

        $this->command->info((count($computers) - count($selectedComputers)) . " computers remain completely free.");
    }
}
