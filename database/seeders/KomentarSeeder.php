<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('komentar')->insert([
            [
                'komentar' => 'Sistem ini sangat membantu!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'komentar' => 'Tolong tambahkan fitur upload dokumen.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'komentar' => 'UI masih bisa ditingkatkan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
