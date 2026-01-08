<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create the Super Admin role explicitly (required before assignment)
        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // 3. Create the Panel User role (optional, often used by Shield)
        Role::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);

        // 4. Generate permissions and policies for all resources
        // This ensures all the "view_users", "create_work_units" etc. permissions exist
        Artisan::call('shield:generate', [
            '--all' => true,
            '--panel' => 'admin', // Ensure we target the admin panel
            '--no-interaction' => true,
            '--option' => 'policies_and_permissions'
        ]);

        $this->command->info('Shield roles and permissions generated successfully.');
    }
}
