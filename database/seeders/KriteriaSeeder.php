<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            DB::table('kriteria')->insert([
                'nama_kriteria' => 'Kriteria ' . $i,
            ]);
        }
    }
}
