<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Struktural',
            'Fungsional Tertentu',
            'Struktural dan Fungsional Tertentu',
            'Staf / Fungsional Umum',
        ];

        foreach ($types as $name) {
            \App\Models\JobType::firstOrCreate(['name' => $name]);
        }
    }
}
