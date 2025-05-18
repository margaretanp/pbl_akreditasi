<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
            ],
            [
                'name' => 'KPS 1',
                'email' => 'kps1@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Pak Kajur',
                'email' => 'kajurtercinta@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Pak Direktur',
                'email' => 'direkturyangbaik10@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 3,
            ],
            [
                'name' => 'KJM 1',
                'email' => 'kjm1@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
            ],
            [
                'name' => 'SPI 1',
                'email' => 'spi@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 4,
            ],
            [
                'name' => 'Dosen 1',
                'email' => 'dosen1@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 2',
                'email' => 'dosen2@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 3',
                'email' => 'dosen3@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 4',
                'email' => 'dosen4@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 5',
                'email' => 'dosen5@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 6',
                'email' => 'dosen6@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 7',
                'email' => 'dosen7@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 8',
                'email' => 'dosen8@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
            [
                'name' => 'Dosen 9',
                'email' => 'dosen9@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 5,
            ],
        ]);
    }
}
