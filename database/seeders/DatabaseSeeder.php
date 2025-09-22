<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::firstOrCreate(['name' => 'manager']);
        Role::firstOrCreate(['name' => 'user']);
        Role::firstOrCreate(['name' => 'admin']);
        // Создаем базовые разрешения
        $permissions = [
            'create users',
            'edit users',
            'delete users',
            'view users',
            'manage roles',
            'create managers',
            'edit managers',
            'delete managers',
            'view managers',
            'create computers',
            'edit computers',
            'delete computers',
            'view computers',
            'view dashboard',
            'access admin dashboard',
            'view computers info',
            'view bookings history',
            'view payments history',
            'view managers info',


        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        $defaultPassword = bcrypt('12345678');

        // 1. Создаем обычных пользователей
        $users = User::factory(8)->create([
            'password' => $defaultPassword
        ])->each(function ($user) {
            $user->assignRole('user');
        });

        // 2. Первые 3 пользователя - менеджеры (только роль, без таблицы managers)
        $users->take(3)->each(function($user) {
            $user->syncRoles('manager'); // Просто назначаем роль менеджера
        });
        $tarifs = [
            [
                'from' => '00:00:00', 'to' => '08:00:00', 'name' => 'Ночной',
                'coefficient' => 0.7, 'description' => 'Скидка 30% в ночное время'
            ],
            [
                'from' => '08:00:00', 'to' => '18:00:00', 'name' => 'Дневной',
                'coefficient' => 1.0, 'description' => 'Стандартная стоимость'
            ],
            [
                'from' => '18:00:00', 'to' => '00:00:00', 'name' => 'Вечерний',
                'coefficient' => 1.2, 'description' => 'Наценка 20% в вечернее время'
            ]
        ];

        foreach ($tarifs as $tarif) {
            \App\Models\Tarif::create($tarif);
        }

        // 2. Ценовые категории компьютеров
        $prices = [
            ['name' => 'Эконом', 'price_per_hour' => 300],
            ['name' => 'Стандарт', 'price_per_hour' => 500],
            ['name' => 'Премиум', 'price_per_hour' => 800],
            ['name' => 'Геймерский', 'price_per_hour' => 1200],
        ];

        $priceModels = [];
        foreach ($prices as $price) {
            $priceModels[] = \App\Models\ComputerPrice::create($price);
        }

        // 3. Создаем спецификации (5 штук)
        $specs = \App\Models\ComputerSpecs::factory(5)->create();

        // 4. Создаем позиции в зале (30 мест)
        $positions = \App\Models\ComputerPosition::factory(30)->create();

        // 5. Создаем компьютеры (15 штук) со связями
        \App\Models\Computer::factory(15)->create([
            'price_id' => function() use ($priceModels) {
                return $priceModels[array_rand($priceModels)]->id;
            },
            'spec_id' => function() use ($specs) {
                return $specs->random()->id;
            },
            'position_id' => function() use ($positions) {
                return $positions->random()->id;
            }
        ]);


//
        // 5. Админ
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');


    }
}
