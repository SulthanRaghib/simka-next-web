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
            RankSeeder::class,
            AsnTypeSeeder::class,
            JobTypeSeeder::class,
            EmploymentStatusSeeder::class,
            WorkUnitSeeder::class,
            JobPositionSeeder::class,
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

        // 3. Create panel user
        $panelUser = User::firstOrCreate(
            // full data users
            ['email' => 'dimas@simka.com'],
            [
                'name' => 'Dimas Prasetyo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'nip' => '198765432109876543',
                'phone_number' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'gender' => 'L',
                'is_active' => true,
                'work_unit_id' => 1,
                'job_position_id' => 1,
                'struktural_position_id' => 1,
                'pangkat_golongan_id' => 1,
                'tmt_golongan' => '2020-01-01',
                'jenis_asn_id' => 1,
                'jenis_jab_id' => 1,
                'employment_status_id' => 1,
                'nama_cetak_tanpa_gelar' => 'Dimas Prasetyo',
                'nama_cetak_dengan_gelar' => 'Dimas Prasetyo, S.Kom',
                'birth_place' => 'Jakarta',
                'birth_date' => '1990-05-15',
            ]
        );

        $panelUser->assignRole('panel_user');
    }
}
