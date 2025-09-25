<?php

namespace Database\Seeders;

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
        $userRole    = Role::firstOrCreate(['name' => 'user']);
        $adminRole   = Role::firstOrCreate(['name' => 'admin']);

        $permissions = [
            'create users', 'edit users', 'delete users', 'view users',
            'manage roles',
            'create managers', 'edit managers', 'delete managers', 'view managers',
            'create computers', 'edit computers', 'delete computers', 'view computers',
            'view dashboard', 'access admin dashboard',
            'view computers info', 'view bookings history', 'view payments history',
            'view managers info',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole->syncPermissions(Permission::all());

        $defaultPassword = bcrypt('12345678');

        $users = User::factory(8)->create([
            'password' => $defaultPassword
        ])->each(fn($user) => $user->syncRoles('user'));

        $users->take(3)->each(fn($user) => $user->syncRoles('manager'));

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => $defaultPassword,
        ])->syncRoles('admin');

        $tariffs = [
            ['name' => 'Ночной',   'coefficient' => 0.7],
            ['name' => 'Дневной',  'coefficient' => 1.0],
            ['name' => 'Вечерний', 'coefficient' => 1.2],
        ];

        foreach ($tariffs as $tariff) {
            Tariff::firstOrCreate($tariff);
        }

        $specs = ComputerSpec::factory(5)->create();
        $positions = ComputerPosition::factory(30)->create();

        Computer::factory(15)->create([
            'spec_id' => fn() => $specs->random()->id,
            'position_id' => fn() => $positions->random()->id,
        ]);

        Food::factory(20)->create();

        Code::factory(10)->create();

        Booking::factory(25)->create();

        Payment::factory(25)->create();
    }
}
