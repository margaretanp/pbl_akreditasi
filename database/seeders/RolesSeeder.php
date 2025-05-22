<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'code' => 'ADM',
                'name' => 'Administrator',
            ],
            [
                'code' => 'VAL1',
                'name' => 'Validator 1',
            ],
            [
                'code' => 'VAL2',
                'name' => 'Validator 2',
            ],
            [
                'code' => 'EXT',
                'name' => 'External',
            ],
            [
                'code' => 'ANG',
                'name' => 'Anggota',
            ],
        ]);
    }
}
