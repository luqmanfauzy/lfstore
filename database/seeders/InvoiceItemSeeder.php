<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('invoice_items')->insert([
            [
                'id'         => 6,
                'invoice_id' => 7,
                'product_id' => 34,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-17 19:32:29',
                'updated_at' => '2026-03-17 19:32:29',
            ],
            [
                'id'         => 7,
                'invoice_id' => 8,
                'product_id' => 52,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-17 20:10:18',
                'updated_at' => '2026-03-17 20:10:18',
            ],
            [
                'id'         => 8,
                'invoice_id' => 8,
                'product_id' => 82,
                'qty'        => 1,
                'price'      => 13000.00,
                'subtotal'   => 13000.00,
                'created_at' => '2026-03-17 20:10:18',
                'updated_at' => '2026-03-17 20:10:18',
            ],
            [
                'id'         => 9,
                'invoice_id' => 9,
                'product_id' => 63,
                'qty'        => 1,
                'price'      => 35000.00,
                'subtotal'   => 35000.00,
                'created_at' => '2026-03-17 20:14:23',
                'updated_at' => '2026-03-17 20:14:23',
            ],
            [
                'id'         => 10,
                'invoice_id' => 9,
                'product_id' => 64,
                'qty'        => 1,
                'price'      => 35000.00,
                'subtotal'   => 35000.00,
                'created_at' => '2026-03-17 20:14:23',
                'updated_at' => '2026-03-17 20:14:23',
            ],
            [
                'id'         => 11,
                'invoice_id' => 10,
                'product_id' => 34,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-17 22:07:17',
                'updated_at' => '2026-03-17 22:07:17',
            ],
            [
                'id'         => 12,
                'invoice_id' => 10,
                'product_id' => 34,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-17 22:07:17',
                'updated_at' => '2026-03-17 22:07:17',
            ],
            [
                'id'         => 15,
                'invoice_id' => 12,
                'product_id' => 33,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-17 22:21:37',
                'updated_at' => '2026-03-17 22:21:37',
            ],
            [
                'id'         => 16,
                'invoice_id' => 12,
                'product_id' => 78,
                'qty'        => 1,
                'price'      => 13000.00,
                'subtotal'   => 13000.00,
                'created_at' => '2026-03-17 22:21:37',
                'updated_at' => '2026-03-17 22:21:37',
            ],
            [
                'id'         => 17,
                'invoice_id' => 13,
                'product_id' => 34,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-17 22:26:11',
                'updated_at' => '2026-03-17 22:26:11',
            ],
            [
                'id'         => 18,
                'invoice_id' => 13,
                'product_id' => 82,
                'qty'        => 1,
                'price'      => 13000.00,
                'subtotal'   => 13000.00,
                'created_at' => '2026-03-17 22:26:11',
                'updated_at' => '2026-03-17 22:26:11',
            ],
            [
                'id'         => 19,
                'invoice_id' => 15,
                'product_id' => 31,
                'qty'        => 1,
                'price'      => 35000.00,
                'subtotal'   => 35000.00,
                'created_at' => '2026-03-18 06:16:26',
                'updated_at' => '2026-03-18 06:16:26',
            ],
            [
                'id'         => 20,
                'invoice_id' => 15,
                'product_id' => 46,
                'qty'        => 1,
                'price'      => 15000.00,
                'subtotal'   => 15000.00,
                'created_at' => '2026-03-18 06:16:26',
                'updated_at' => '2026-03-18 06:16:26',
            ],
            [
                'id'         => 21,
                'invoice_id' => 16,
                'product_id' => 65,
                'qty'        => 1,
                'price'      => 35000.00,
                'subtotal'   => 35000.00,
                'created_at' => '2026-03-18 06:27:39',
                'updated_at' => '2026-03-18 06:27:39',
            ],
        ]);

        DB::statement('ALTER TABLE invoice_items AUTO_INCREMENT = 22');
    }
}
