<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['id' => 1, 'name' => 'Kepala (Es-1)'],
            ['id' => 2, 'name' => 'Deputi (Es-1)'],
            ['id' => 3, 'name' => 'Sekretaris Utama (Es-1)'],
            ['id' => 4, 'name' => 'Direktur (Es-2)'],
            ['id' => 5, 'name' => 'Kepala Pusat (Es-2)'],
            ['id' => 6, 'name' => 'Kepala Inspektorat (Es-2)'],
            ['id' => 7, 'name' => 'Kepala Biro (Es-2)'],
            ['id' => 8, 'name' => 'Kepala Subdirektorat (Es-3)'],
            ['id' => 9, 'name' => 'Kepala Bagian (Es-3)'],
            ['id' => 10, 'name' => 'Kepala Bidang (Es-3)'],
            ['id' => 11, 'name' => 'Kepala Balai (Es-3)'],
            ['id' => 12, 'name' => 'Kepala Subbagian (Es-4)'],
            ['id' => 13, 'name' => 'Pengelola Kegiatan (Es-3)'],
            ['id' => 14, 'name' => 'Sub Koordinator (Es-4)'],
            ['id' => 15, 'name' => 'Kepala Seksi (Es-4)'],
            ['id' => 16, 'name' => 'Kepala Kelompok (Es-3)'],
            ['id' => 17, 'name' => 'Sekretaris (Es-99)'],
            ['id' => 99, 'name' => 'Staf (Es-99)'],
            // ['id' => 0, 'name' => '- (Es-99)'], // Skipping ID 0 as it often causes issues with auto-increment
        ];

        JobPosition::unguard();
        foreach ($positions as $position) {
            JobPosition::updateOrCreate(
                ['id' => $position['id']],
                ['name' => $position['name']]
            );
        }
        JobPosition::reguard();
    }
}
