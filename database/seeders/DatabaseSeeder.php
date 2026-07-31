<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        User::factory(10)->create();

        $adminUser = User::query()->updateOrCreate(
            ['email' => 'arif.abdul0002@gmail.com'],
            [
                'name' => 'arif',
                'password' => '12345678',
            ],
        );
        $adminUser->assignRole($superAdminRole);

        $staffUser = User::query()->updateOrCreate(
            ['email' => 'lalana@gmail.com'],
            [
                'name' => 'lalana',
                'password' => '12345678',
            ],
        );

        $staffUser->assignRole($staffRole);

        $this->call([
            BeritaSeeder::class,
            BuletinSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
