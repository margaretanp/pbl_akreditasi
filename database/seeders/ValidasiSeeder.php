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
        DB::table('validasi')->insert([
            [
                'id_validator'    => 2,
                'id_user'         => 2,
                'validated_date'  => Carbon::now()->subDays(3),
                'notes'           => 'All documents verified.',
                'status'          => 'approved',
            ],
            [
                'id_validator'    => 2,
                'id_user'         => 2,
                'validated_date'  => Carbon::now()->subDays(1),
                'notes'           => 'Incomplete requirements.',
                'status'          => 'rejected',
            ],
            [
                'id_validator'    => 3,
                'id_user'         => 4,
                'validated_date'  => Carbon::now(),
                'notes'           => 'Pending final review.',
                'status'          => 'pending',
            ]
        ]);
    }
}
