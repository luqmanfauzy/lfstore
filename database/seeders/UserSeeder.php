<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'                => 1,
                'name'              => 'Luqman',
                'email'             => 'luqmannfauzy46@gmail.com',
                'email_verified_at' => null,
                'password'          => '$2y$12$THAv.O3Qe7TFTOtzuj/q9./MtqoLq5FvmWrRiKhMOSP1FW0Q4onqe',
                'remember_token'    => 'SvOwVwGnKF5rwZbVamUjJS6ePELOHQLuuxlbpD6rBYyCyyEwdoH02BoiXegA',
                'created_at'        => '2025-05-09 17:47:38',
                'updated_at'        => '2025-05-09 17:47:38',
            ],
        ]);

        // Reset auto increment
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 2');
    }
}
