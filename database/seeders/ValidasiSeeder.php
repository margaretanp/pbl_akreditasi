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
                'id_user'         => 2,
                'id_detail_kriteria' => 1,
                'validated_at'  => Carbon::now()->subDays(3),
                'komentar'          => 'All documents verified.',
                'status'          => 'valid',
            ],
            [
                'id_user'         => 2,
                'id_detail_kriteria' => 2,
                'validated_at'  => Carbon::now()->subDays(1),
                'komentar'          => 'Incomplete requirements.',
                'status'          => 'invalid',
            ],
            [
                'id_user'         => 4,
                'id_detail_kriteria' => 3,
                'validated_at'  => Carbon::now(),
                'komentar'          => 'Pending final review.',
                'status'          => 'pending',
            ]
        ]);
    }
}
