<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ValidasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('validators')->insert([
            [
                'criteria_id' => 1,
                'user_id' => 3,
            ],
            [
                'criteria_id' => 2,
                'user_id' => 3,
            ],
            [
                'criteria_id' => 3,
                'user_id' => 3,
            ],
            [
                'criteria_id' => 4,
                'user_id' => 4,
            ],
            [
                'criteria_id' => 2,
                'user_id' => 4,
            ],
            [
                'criteria_id' => 3,
                'user_id' => 4,
            ]
        ]);
    }
}
