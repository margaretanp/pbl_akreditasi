<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('roles')->insert([
            [
                'code' => 'ADM',
                'name' => 'Administrator',
            ],
            [
                'code' => 'DSN',
                'name' => 'Dosen',
            ],
            [
                'code' => 'KJM',
                'name' => 'Kantor Jaminan Mutu',
            ],
            [
                'code' => 'KPS',
                'name' => 'Ketua Program Studi',
            ],
            [
                'code' => 'KJR',
                'name' => 'Ketua Jurusan',
            ],
            [
                'code' => 'DKR',
                'name' => 'Direktur'
            ]
        ]);
    }
}
