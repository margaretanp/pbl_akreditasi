<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Validasi;

class ValidasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Validasi::create([
            'id_validator' => 1,
            'id_user' => 2,
            'validated_at' => Carbon::now(),
            'notes' => 'Semua dokumen telah sesuai.',
            'status' => 'valid',
        ]);

        Validasi::create([
            'id_validator' => 1,
            'id_user' => 3,
            'validated_at' => Carbon::now()->subDay(),
            'notes' => 'Terdapat kekurangan pada dokumen A.',
            'status' => 'invalid',
        ]);

        Validasi::create([
            'id_validator' => 2,
            'id_user' => 4,
            'validated_at' => null,
            'notes' => null,
            'status' => 'pending',
        ]);
    }
}
