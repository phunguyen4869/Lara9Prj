<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nguyễn Trần Phú PHP Dev',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123'),
            'phone' => '0848818727',
            'address' => 'Vung Tau',
            'payment_method' => 'credit_card',
            'email_verified_at' => now(),
        ]);

        UserFactory::times(10)->create();
    }
}
