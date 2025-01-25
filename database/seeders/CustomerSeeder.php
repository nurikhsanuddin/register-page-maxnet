<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //customer seeder
        DB::table('customers')->insert([
            'customer_id' => 'CUST-001',
            'customer_name' => 'John Doe',
            'customer_email' => 'sandincoba@gmail.com',
            'customer_password' => bcrypt('sandin123'),
            'customer_address' => 'Jl. Raya Kedungwuni No. 1',
            'customer_phone' => '081234567890',
            'customer_ktp_no' => '1234567890',
            'customer_ktp_picture' => 'ktp.jpg',
            'password_reset' => 1,

        ]);
    }
}
