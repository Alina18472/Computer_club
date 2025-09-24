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

        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
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

        $adminRole->syncPermissions(Permission::all());
        $defaultPassword = bcrypt('12345678');

        // 1. Создаем обычных пользователей
        $users = User::factory(8)->create([
            'password' => $defaultPassword
        ])->each(function ($user) {
            $user->syncRoles('user');
        });

        // 2. Первые 3 пользователя - менеджеры
        $users->take(3)->each(function($user) {
            $user->syncRoles('manager');
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
            \App\Models\Tariff::create($tarif);
        }

        //  Ценовые категории компьютеров
        $prices = [
            ['name' => 'Эконом', 'price_per_hour' => 300],
            ['name' => 'Стандарт', 'price_per_hour' => 500],
            ['name' => 'Премиум', 'price_per_hour' => 800],
            ['name' => 'Геймерский', 'price_per_hour' => 1200],
        ];

        $priceModels = [];

        //  Создаем спецификации (5 штук)
        $specs = \App\Models\ComputerSpec::factory(5)->create();

        //  Создаем позиции в зале (30 мест)
        $positions = \App\Models\ComputerPosition::factory(30)->create();

        //  Создаем компьютеры (15 штук)
        \App\Models\Computer::factory(15)->create([
            'spec_id' => function() use ($specs) {
                return $specs->random()->id;
            },
            'position_id' => function() use ($positions) {
                return $positions->random()->id;
            }
        ]);



        // 5. Админ
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678')
        ])->syncRoles('admin');


    }
}
