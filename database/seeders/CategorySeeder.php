<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Điện thoại',
            'parent_id' => 0,
            'description' => 'Điện thoại',
            'content' => 'Điện thoại các loại',
            'slug' => 'dien-thoai',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Máy tính bảng',
            'parent_id' => 0,
            'description' => 'Máy tính bảng',
            'content' => 'Máy tính bảng các loại',
            'slug' => 'may-tinh-bang',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'PC',
            'parent_id' => 0,
            'description' => 'PC',
            'content' => 'PC các loại',
            'slug' => 'pc',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Laptop',
            'parent_id' => 0,
            'description' => 'Laptop',
            'content' => 'Laptop các loại',
            'slug' => 'laptop',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Phụ kiện',
            'parent_id' => 0,
            'description' => 'Phụ kiện',
            'content' => 'Phụ kiện các loại',
            'slug' => 'phu-kien',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Apple',
            'parent_id' => 1,
            'description' => 'Apple',
            'content' => 'Apple các loại',
            'slug' => 'apple',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Samsung',
            'parent_id' => 1,
            'description' => 'Samsung',
            'content' => 'Samsung các loại',
            'slug' => 'samsung',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'iPhone',
            'parent_id' => 6,
            'description' => 'iPhone',
            'content' => 'iPhone các loại',
            'slug' => 'iphone',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Macbook',
            'parent_id' => 6,
            'description' => 'Macbook',
            'content' => 'Macbook các loại',
            'slug' => 'macbook',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
