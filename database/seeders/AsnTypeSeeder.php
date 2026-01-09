<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsnTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['PNS', 'CPNS', 'PPNPN', 'PPPK'];

        foreach ($types as $i => $name) {
            \App\Models\AsnType::firstOrCreate(['name' => $name]);
        }
    }
}
