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
        DB::table('detail_criteria')->insert([
            [
                'criteria_id' => 1,
                'jenis_criteria_id' => 1,
                'description' => 'Detail for kriteria 1, jenis kriteria 1',
                'created_by' => 7,
            ],
            [
                'criteria_id' => 1,
                'jenis_criteria_id' => 2,
                'description' => 'Detail for kriteria 1, jenis kriteria 2',
                'created_by' => 8,
            ],
            [
                'criteria_id' => 1,
                'jenis_criteria_id' => 3,
                'description' => 'Detail for kriteria 1, jenis kriteria 3',
                'created_by' => 9,
            ],
            [
                'criteria_id' => 1,
                'jenis_criteria_id' => 4,
                'description' => 'Detail for kriteria 1, jenis kriteria 4',
                'created_by' => 10,
            ],
            [
                'criteria_id' => 1,
                'jenis_criteria_id' => 5,
                'description' => 'Detail for kriteria 1, jenis kriteria 5',
                'created_by' => 11,
            ]
        ]);
    }
}
