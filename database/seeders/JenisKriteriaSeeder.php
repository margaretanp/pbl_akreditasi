<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_criteria')->insert([
            [
                'name' => 'Penetapan',
            ],
            [
                'name' => 'Pelaksanaan',
            ],
            [
                'name' => 'Evaluasi',
            ],
            [
                'name' => 'Pengendalian',
            ],
            [
                'name' => 'Peningkatan',
            ],
        ]);
    }
}
