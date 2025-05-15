<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        for ($i = 1; $i <= 15; $i++) {
            \DB::table('users')->insert([
                'role_id' => $faker->numberBetween(1, 6),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('123456'),
                'name' => $faker->name(),
            ]);
            
        };
    }
}
