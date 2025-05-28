<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_kriteria')->insert([
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 1,
                'file_url' => null,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 2,
                'file_url' => null,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 3,
                'file_url' => null,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 4,
                'file_url' => null,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 5,
                'file_url' => null,
            ]
        ]);
    }
}
