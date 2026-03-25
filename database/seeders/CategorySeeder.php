<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id'            => 1,
                'category_name' => 'kaos kaki pendek',
                'slug'          => 'kaos-kaki-pendek',
                'created_at'    => '2025-05-09 17:50:12',
                'updated_at'    => '2025-05-13 06:00:09',
            ],
            [
                'id'            => 2,
                'category_name' => 'kacamata anti radiasi',
                'slug'          => 'kacamata-anti-radiasi',
                'created_at'    => '2025-05-09 17:50:08',
                'updated_at'    => '2025-05-09 17:50:08',
            ],
            [
                'id'            => 3,
                'category_name' => 'kacamata photocromic',
                'slug'          => 'kacamata-photocromic',
                'created_at'    => '2025-05-09 17:50:03',
                'updated_at'    => '2025-05-09 17:50:03',
            ],
            [
                'id'            => 12,
                'category_name' => 'kacamata hitam',
                'slug'          => 'kacamata-hitam',
                'created_at'    => '2025-05-14 05:49:57',
                'updated_at'    => '2025-05-14 05:49:57',
            ],
            [
                'id'            => 13,
                'category_name' => 'kacamata style',
                'slug'          => 'kacamata-style',
                'created_at'    => '2025-05-14 07:17:04',
                'updated_at'    => '2025-05-14 07:17:04',
            ],
            [
                'id'            => 14,
                'category_name' => 'other',
                'slug'          => 'other',
                'created_at'    => '2026-03-14 07:41:03',
                'updated_at'    => '2026-03-14 07:41:03',
            ],
            [
                'id'            => 15,
                'category_name' => 'kacamata baca (plus) ',
                'slug'          => 'kacamata-baca-plus',
                'created_at'    => '2026-03-16 02:55:23',
                'updated_at'    => '2026-03-16 02:55:23',
            ],
        ]);

        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 16');
    }
}
