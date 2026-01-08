<?php

namespace Database\Seeders;

use App\Models\WorkUnit;
use Illuminate\Database\Seeder;

class WorkUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Direktorat Pengaturan Pengawasan Instalasi dan Bahan Nuklir', 'code' => 'DP2IBN'],
            ['name' => 'Direktorat Perizinan Instalasi dan Bahan Nuklir', 'code' => 'DPIBN'],
            ['name' => 'Direktorat Inspeksi Instalasi dan Bahan Nuklir', 'code' => 'DIIBN'],
            ['name' => 'Direktorat Keteknikan dan Kesiapsiagaan Nuklir', 'code' => 'DKKN'],
            ['name' => 'Biro Hukum, Kerja Sama dan Komunikasi Publik', 'code' => 'BHKK'],
            ['name' => 'Biro Perencanaan, Informasi dan Keuangan', 'code' => 'BPIK'],
            ['name' => 'Biro Umum', 'code' => 'BU'],
        ];

        foreach ($units as $unit) {
            WorkUnit::firstOrCreate(['code' => $unit['code']], $unit);
        }
    }
}
