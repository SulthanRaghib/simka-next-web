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
            ['code' => '100000', 'name' => 'BAPETEN (Es-1)'],
            ['code' => '110000', 'name' => 'Deputi Perizinan dan Inspeksi (Es-1)'],
            ['code' => '111000', 'name' => 'Direktorat Inspeksi Fasilitas Radiasi dan Zat Radioaktif (Es-2)'],
            ['code' => '111300', 'name' => 'Kelompok Fungsi Inspeksi Fasilitas Penelitian dan Industri (Es-3)'],
            ['code' => '111400', 'name' => 'Kelompok Fungsi Inspeksi Fasilitas Kesehatan (Es-3)'],
            ['code' => '112000', 'name' => 'Direktorat Perizinan Instalasi dan Bahan Nuklir (Es-2)'],
            ['code' => '112400', 'name' => 'Kelompok Fungsi Perizinan Reaktor dan Bahan Nuklir (Es-3)'],
            ['code' => '112500', 'name' => 'Kelompok Fungsi Sertifikasi dan Validasi (Es-3)'],
            ['code' => '112600', 'name' => 'Kelompok Fungsi Perizinan Instalasi Nuklir Non Reaktor (Es-3)'],
            ['code' => '113000', 'name' => 'Direktorat Perizinan Fasilitas Radiasi dan Zat Radioaktif (Es-2)'],
            ['code' => '113400', 'name' => 'Kelompok Fungsi Perizinan Fasilitas Penelitian dan Industri (Es-3)'],
            ['code' => '113500', 'name' => 'Kelompok Fungsi Perizinan Fasilitas Kesehatan (Es-3)'],
            ['code' => '113600', 'name' => 'Kelompok Fungsi Perizinan Petugas Fasilitas Radiasi (Es-3)'],
            ['code' => '114000', 'name' => 'Direktorat Inspeksi Instalasi dan Bahan Nuklir (Es-2)'],
            ['code' => '114400', 'name' => 'Kelompok Fungsi Inspeksi Instalasi Nuklir (Es-3)'],
            ['code' => '114500', 'name' => 'Kelompok Fungsi Inspeksi Safeguards (Es-3)'],
            ['code' => '114600', 'name' => 'Kelompok Fungsi Evaluasi Dosis dan Lingkungan (Es-3)'],
            ['code' => '115000', 'name' => 'Direktorat Keteknikan dan Kesiapsiagaan Nuklir (Es-2)'],
            ['code' => '115400', 'name' => 'Kelompok Fungsi Keteknikan (Es-3)'],
            ['code' => '115500', 'name' => 'Kelompok Fungsi Jaminan Mutu (Es-3)'],
            ['code' => '115600', 'name' => 'Kelompok Fungsi Kesiapsiagaan Nuklir (Es-3)'],
            ['code' => '120000', 'name' => 'Deputi Pengkajian Keselamatan Nuklir (Es-1)'],
            ['code' => '121000', 'name' => 'Pusat Pengkajian Sistem dan Teknologi Pengawasan Instalasi dan Bahan Nuklir (Es-2)'],
            ['code' => '121400', 'name' => 'Kelompok Fungsi Pengkajian Reaktor Daya (Es-3)'],
            ['code' => '121500', 'name' => 'Kelompok Fungsi Pengkajian Reaktor Non Daya (Es-3)'],
            ['code' => '121600', 'name' => 'Kelompok Fungsi Pengkajian Instalasi Nuklir Non Reaktor (Es-3)'],
            ['code' => '122000', 'name' => 'Pusat Pengkajian Sistem dan Teknologi Pengawasan Fasilitas Radiasi dan Zat Radioaktif (Es-2)'],
            ['code' => '122300', 'name' => 'Kelompok Fungsi Pengkajian Kesehatan (Es-3)'],
            ['code' => '122400', 'name' => 'Kelompok Fungsi Pengkajian Industri dan Penelitian (Es-3)'],
            ['code' => '123000', 'name' => 'Direktorat Pengaturan Pengawasan Fasilitas Radiasi dan Zat Radioaktif (Es-2)'],
            ['code' => '123300', 'name' => 'Kelompok Fungsi Pengaturan Kesehatan, Industri dan Penelitian (Es-3)'],
            ['code' => '123400', 'name' => 'Kelompok Fungsi Pengaturan Proteksi Radiasi dan Keselamatan Lingkungan (Es-3)'],
            ['code' => '124000', 'name' => 'Direktorat Pengaturan Pengawasan Instalasi dan Bahan Nuklir (Es-2)'],
            ['code' => '124400', 'name' => 'Kelompok Fungsi Pengaturan Reaktor Daya (Es-3)'],
            ['code' => '124500', 'name' => 'Kelompok Fungsi Pengaturan Reaktor Non Daya (Es-3)'],
            ['code' => '124600', 'name' => 'Kelompok Fungsi Pengaturan Instalasi Nuklir Non Reaktor (Es-3)'],
            ['code' => '130000', 'name' => 'Sekretariat Utama (Es-1)'],
            ['code' => '131000', 'name' => 'Biro Perencanaan, Informasi dan Keuangan (Es-2)'],
            ['code' => '131600', 'name' => 'Kelompok Fungsi Data dan Informasi (Es-3)'],
            ['code' => '131610', 'name' => 'Subkelompok Fungsi Informasi Ilmiah (Es-4)'],
            ['code' => '131620', 'name' => 'Subkelompok Fungsi Infrastruktur Informasi (Es-4)'],
            ['code' => '131630', 'name' => 'Subkelompok Fungsi Pengelolaan Data (Es-4)'],
            ['code' => '131700', 'name' => 'Kelompok Fungsi Program (Es-3)'],
            ['code' => '131710', 'name' => 'Subkelompok Fungsi Penyusunan Program dan Penganggaran (Es-4)'],
            ['code' => '131720', 'name' => 'Subkelompok Fungsi Pemantauan dan Evaluasi (Es-4)'],
            ['code' => '131800', 'name' => 'Kelompok Fungsi Keuangan (Es-3)'],
            ['code' => '131810', 'name' => 'Subkelompok Fungsi Kas dan Perbendaharaan (Es-4)'],
            ['code' => '131820', 'name' => 'Subkelompok Fungsi Verifikasi dan Pelaporan (Es-4)'],
            ['code' => '132000', 'name' => 'Biro Organisasi dan Umum (Es-2)'],
            ['code' => '132500', 'name' => 'Kelompok Fungsi Sumber Daya Manusia (Es-3)'],
            ['code' => '132510', 'name' => 'Subkelompok Fungsi Administrasi Kepegawaian (Es-4)'],
            ['code' => '132520', 'name' => 'Subkelompok Fungsi Pengelolaan Jabatan Fungsional (Es-4)'],
            ['code' => '132530', 'name' => 'Subkelompok Fungsi Perencanaan dan Pengembangan Sumber Daya Manusia (Es-4)'],
            ['code' => '132600', 'name' => 'Kelompok Fungsi Organisasi dan Tata Laksana (Es-3)'],
            ['code' => '132610', 'name' => 'Subkelompok Fungsi Organisasi (Es-4)'],
            ['code' => '132620', 'name' => 'Subkelompok Fungsi Tata Laksana (Es-4)'],
            ['code' => '132700', 'name' => 'Bagian Rumah Tangga dan Barang Milik Negara (Es-3)'],
            ['code' => '132710', 'name' => 'Subbagian Rumah Tangga dan Pengamanan (Es-4)'],
            ['code' => '132720', 'name' => 'Subbagian Barang Milik Negara dan Pengadaan (Es-4)'],
            ['code' => '132800', 'name' => 'Bagian Protokol dan Tata Usaha (Es-3)'],
            ['code' => '132810', 'name' => 'Subbagian Tata Usaha Kepala (Es-4)'],
            ['code' => '132820', 'name' => 'Subbagian Tata Usaha Deputi Perijinan dan Inspeksi (Es-4)'],
            ['code' => '132830', 'name' => 'Subbagian Tata Usaha Deputi Pengkajian Keselamatan Nuklir (Es-4)'],
            ['code' => '133000', 'name' => 'Biro Hukum, Kerjasama dan Komunikasi Publik (Es-2)'],
            ['code' => '133600', 'name' => 'Kelompok Fungsi Hukum (Es-3)'],
            ['code' => '133610', 'name' => 'Subkelompok Fungsi Advokasi Hukum (Es-4)'],
            ['code' => '133620', 'name' => 'Subkelompok Fungsi Administrasi Hukum (Es-4)'],
            ['code' => '133700', 'name' => 'Kelompok Fungsi Komunikasi Publik (Es-3)'],
            ['code' => '133710', 'name' => 'Subkelompok Fungsi Hubungan Masyarakat (Es-4)'],
            ['code' => '133800', 'name' => 'Kelompok Fungsi Kerjasama (Es-3)'],
            ['code' => '133810', 'name' => 'Subkelompok Fungsi Kerjasama Dalam Negeri (Es-4)'],
            ['code' => '133820', 'name' => 'Subkelompok Fungsi Kerjasama Luar Negeri (Es-4)'],
            ['code' => '151000', 'name' => 'Inspektorat (Es-2)'],
            ['code' => '151100', 'name' => 'Kelompok Fungsional Auditor (Es-3)'],
            ['code' => '151210', 'name' => 'Subbagian Tata Usaha (Es-4)'],
            ['code' => '161100', 'name' => 'Balai Pendidikan dan Pelatihan (Es-3)'],
            ['code' => '161110', 'name' => 'Subbagian Umum (Es-4)'],
            ['code' => '161140', 'name' => 'Kelompok Jabatan Fungsional Widyaiswara (Es-4)'],
            ['code' => '161160', 'name' => 'Subkelompok Fungsi Program dan Evaluasi (Es-4)'],
            ['code' => '161170', 'name' => 'Subkelompok Fungsi Penyelenggaraan dan Sarana Pelatihan (Es-4)'],
        ];

        foreach ($units as $unit) {
            WorkUnit::firstOrCreate(['code' => $unit['code']], $unit);
        }
    }
}
