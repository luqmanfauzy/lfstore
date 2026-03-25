<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('invoices')->insert([
            [
                'id'               => 7,
                'invoice'          => 'INV-20260318-0001',
                'date'             => '2026-03-18',
                'customer_name'    => 'toto sugiri',
                'total_purchases'  => 15000.00,
                'shipping_cost'    => 0.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'cod',
                'created_at'       => '2026-03-17 19:32:29',
                'updated_at'       => '2026-03-17 19:32:29',
            ],
            [
                'id'               => 8,
                'invoice'          => 'INV-20260318-0002',
                'date'             => '2026-03-18',
                'customer_name'    => 'budi hartono',
                'total_purchases'  => 28001.00,
                'shipping_cost'    => 1.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'transfer',
                'created_at'       => '2026-03-17 20:10:18',
                'updated_at'       => '2026-03-17 20:10:18',
            ],
            [
                'id'               => 9,
                'invoice'          => 'INV-20260318-0003',
                'date'             => '2026-03-18',
                'customer_name'    => 'luqman',
                'total_purchases'  => 85000.00,
                'shipping_cost'    => 15000.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'transfer',
                'created_at'       => '2026-03-17 20:14:23',
                'updated_at'       => '2026-03-17 20:14:23',
            ],
            [
                'id'               => 10,
                'invoice'          => 'INV-20260318-0004',
                'date'             => '2026-03-18',
                'customer_name'    => 'ardi subagya',
                'total_purchases'  => 40000.00,
                'shipping_cost'    => 10000.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'transfer',
                'created_at'       => '2026-03-17 22:07:16',
                'updated_at'       => '2026-03-17 22:07:16',
            ],
            [
                'id'               => 12,
                'invoice'          => 'INV-20260318-05',
                'date'             => '2026-03-18',
                'customer_name'    => 'alfian',
                'total_purchases'  => 46000.00,
                'shipping_cost'    => 18000.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'transfer',
                'created_at'       => '2026-03-17 22:21:37',
                'updated_at'       => '2026-03-17 22:21:37',
            ],
            [
                'id'               => 13,
                'invoice'          => 'INV-20260318-09',
                'date'             => '2026-03-16',
                'customer_name'    => 'tiara android',
                'total_purchases'  => 47000.00,
                'shipping_cost'    => 19000.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'cod',
                'created_at'       => '2026-03-17 22:26:11',
                'updated_at'       => '2026-03-17 22:26:11',
            ],
            [
                'id'               => 15,
                'invoice'          => 'INV-20260318-10',
                'date'             => '2026-03-18',
                'customer_name'    => 'sugeng',
                'total_purchases'  => 60000.00,
                'shipping_cost'    => 12000.00,
                'discount_name'    => null,
                'discount_nominal' => 0.00,
                'payment_method'   => 'cod',
                'created_at'       => '2026-03-18 06:16:26',
                'updated_at'       => '2026-03-18 06:16:26',
            ],
            [
                'id'               => 16,
                'invoice'          => 'INV-20260318-11',
                'date'             => '2026-03-18',
                'customer_name'    => 'fahmi',
                'total_purchases'  => 45000.00,
                'shipping_cost'    => 13000.00,
                'discount_name'    => 'diskon ongkir',
                'discount_nominal' => 3000.00,
                'payment_method'   => 'transfer',
                'created_at'       => '2026-03-18 06:27:39',
                'updated_at'       => '2026-03-18 06:27:39',
            ],
        ]);

        DB::statement('ALTER TABLE invoices AUTO_INCREMENT = 17');
    }
}
