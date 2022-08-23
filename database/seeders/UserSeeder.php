<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'thanghorit@gmail.com',
                'password' => Hash::make('123123'),
                'first_name' => 'Thang',
                'last_name' => 'Quang',
                'first_name_surname' => 'rit',
                'last_name_surname' => 'kdps',
                'gender' => 1,
                'phone' => '0971504302',
                'email_verified' => 1,
                'hobby' => 'ThD',
                'address' => '141 Nguyen Xi, phuong Hoa Minh, quan Lien chieu, thanh pho Da Nang',
            ],
        ]);
    }
}
