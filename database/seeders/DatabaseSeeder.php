<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InventorySeeder::class);
    }
}
class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'email' => 'admin',
                'password' => '123',
                'name' => 'admin',
            ],
        ]);
    }
}
class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'thanghorit@gmail.com',
                'password' => '123',
                'first_name' => 'Thang',
                'last_name' => 'Quang',
                'first_name_surname' => 'rit',
                'last_name_surname' => 'kdps',
                'gender' => 1,
                'phone' => '0971504302',
                'hobby' => 'ThD',
                'address' => '141 Nguyen Xi, phuong Hoa Minh, quan Lien chieu, thanh pho Da Nang',
            ],
        ]);
    }
}
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
