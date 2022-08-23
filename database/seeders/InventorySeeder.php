<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    public function run()
    {
        DB::table('inventories')->insert([
            [
                'product_name' => 'Coca Cola',
                'quantity' => '100',
            ],
            [
                'product_name' => 'Pesical',
                'quantity' => '100',
            ],
            [
                'product_name' => 'Sprite',
                'quantity' => '100',
            ], [
                'product_name' => 'Mirinda',
                'quantity' => '100',
            ],
        ]);
    }
}
