<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Setup Roles & Permissions first
        $this->call([
            ShieldSeeder::class,
            WorkUnitSeeder::class,
        ]);

        // 2. Create the user
        $user = User::firstOrCreate(
            ['email' => 'admin@simka.com'], // Identifier
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Assign the role (now guaranteed to exist)
        $user->assignRole('super_admin');
    }
}
