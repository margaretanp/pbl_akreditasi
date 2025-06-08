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
                'description' => 'Detail for kriteria 1, jenis kriteria 1',
                'file_url' => 'null',
                'created_by' => 7,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 2,
                'description' => 'Detail for kriteria 1, jenis kriteria 2',
                'file_url' => 'null',
                'created_by' => 8,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 3,
                'description' => 'Detail for kriteria 1, jenis kriteria 3',
                'file_url' => 'null',
                'created_by' => 9,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 4,
                'description' => 'Detail for kriteria 1, jenis kriteria 4',
                'file_url' => 'null',
                'created_by' => 10,
            ],
            [
                'kriteria_id' => 1,
                'jenis_kriteria_id' => 5,
                'description' => 'Detail for kriteria 1, jenis kriteria 5',
                'file_url' => 'null',
                'created_by' => 11,
            ]
        ]);
    }
}
