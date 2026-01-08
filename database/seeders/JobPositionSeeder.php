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
            ['name' => 'Kepala BAPETEN', 'grade' => 17],
            ['name' => 'Sekretaris Utama', 'grade' => 16],
            ['name' => 'Deputi Perizinan dan Inspeksi', 'grade' => 16],
            ['name' => 'Deputi Pengkajian Keselamatan Nuklir', 'grade' => 16],
            ['name' => 'Direktur Pengaturan Pengawasan Instalasi dan Bahan Nuklir', 'grade' => 15],
            ['name' => 'Analis Kepegawaian Ahli Muda', 'grade' => 10],
            ['name' => 'Pranata Komputer Ahli Pertama', 'grade' => 9],
            ['name' => 'Arsiparis Mahir', 'grade' => 8],
            ['name' => 'Pengadministrasi Umum', 'grade' => 5],
        ];

        foreach ($positions as $position) {
            JobPosition::firstOrCreate(['name' => $position['name']], $position);
        }
    }
}
