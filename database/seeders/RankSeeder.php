<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            ['id' => 24, 'name' => 'Ahli Pertama S-2 PPPK (X)'],
            ['id' => 23, 'name' => 'Ahli Pertama D-IV/S-1 PPPK (IX)'],
            ['id' => 21, 'name' => 'Terampil D-III PPPK (VII)'],
            ['id' => 20, 'name' => 'PPNPN (II/a)'],
            ['id' => 19, 'name' => 'Kontrak (K)'],
            ['id' => 18, 'name' => 'Honorer (H)'],
            ['id' => 17, 'name' => 'Juru Muda (I/a)'],
            ['id' => 16, 'name' => 'Juru Muda Tk. I (I/b)'],
            ['id' => 15, 'name' => 'Juru (I/c)'],
            ['id' => 14, 'name' => 'Juru Tk. I (I/d)'],
            ['id' => 13, 'name' => 'Pengatur Muda (II/a)'],
            ['id' => 12, 'name' => 'Pengatur Muda Tk. I (II/b)'],
            ['id' => 11, 'name' => 'Pengatur (II/c)'],
            ['id' => 10, 'name' => 'Pengatur Tk. I (II/d)'],
            ['id' => 9, 'name' => 'Penata Muda (III/a)'],
            ['id' => 8, 'name' => 'Penata Muda Tk. I (III/b)'],
            ['id' => 7, 'name' => 'Penata (III/c)'],
            ['id' => 6, 'name' => 'Penata Tk. I (III/d)'],
            ['id' => 5, 'name' => 'Pembina (IV/a)'],
            ['id' => 4, 'name' => 'Pembina Tk I (IV/b)'],
            ['id' => 3, 'name' => 'Pembina Utama Muda (IV/c)'],
            ['id' => 2, 'name' => 'Pembina Utama Madya (IV/d)'],
            ['id' => 1, 'name' => 'Pembina Utama (IV/e)'],
        ];

        foreach ($ranks as $r) {
            \App\Models\Rank::updateOrCreate(['id' => $r['id']], $r);
        }
    }
}
