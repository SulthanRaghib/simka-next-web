<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Aktif',
            'CLTN',
            'Tugas Belajar',
            'Pemberhentian Sementara',
            'Penerima Uang Tunggu',
            'Prajurit Wajib',
            'Pejabat Negara',
            'Kepala Desa',
            'Sedang dalam proses banding ke BAPEK',
            'Masa Persiapan Pensiun',
            'Pensiun',
            'Berhenti dari PNS',
            'Pindah lembaga',
            'Meninggal Dunia',
            'Diperbantukan pada instansi lain (DPB)',
        ];

        foreach ($statuses as $s) {
            \App\Models\EmploymentStatus::firstOrCreate(['name' => $s]);
        }
    }
}
