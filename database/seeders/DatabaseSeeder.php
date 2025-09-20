<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::firstOrCreate(['name' => 'manager']);
        Role::firstOrCreate(['name' => 'partner']);
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
            'create partners',
            'edit partners',
            'delete partners',
            'view partners',
            'create requests',
            'edit requests',
            'delete requests',
            'view requests',
            'view dashboard',
            'view posts',

            'access admin dashboard',
            'transfer requests',
            'view requests info',
            'view requests history',
            'view managers info',
            'view partners info',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

//
//        $adminRole = Role::findByName('admin');
//        $adminRole->syncPermissions(Permission::all());


        $defaultPassword = bcrypt('123456');

        // 1. Создаем обычных пользователей
        $users = User::factory(8)->create([
            'password' => $defaultPassword
        ])->each(function ($user) {
            $user->assignRole('user');
        });

//
//        // 2. Первые 3 - менеджеры
//        $users->take(3)->each(function($user) {
//            Manager::factory()->forUser($user)->create();
//            $user->syncRoles('manager'); // Назначаем роль менеджера
//        });
//
//        // 3. Следующие 2 - партнеры
//        $users->slice(3)->take(2)->each(function($user) {
//            Partner::factory()->forUser($user)->create();
//            $user->syncRoles('partner'); // Назначаем роль партнера
//        });
//
//        // 4. Заявки
//        Request::factory(10)->create();
//
//        // 5. Админ
//        User::factory()->create([
//            'name' => 'Admin',
//            'email' => 'admin@example.com',
//            'password' => bcrypt('password123')
//        ])->assignRole('admin');

        // 6. Тестовый пользователь для демонстрации
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $defaultPassword,
        ])->assignRole('user');
    }
}
