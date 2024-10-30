<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'super_user' => 1,
                'email' => 'daniel.jack.fisher@gmail.com',
                'password' => bcrypt('Password123'),
                'name' => 'Daniel Fisher',
                'is_deleted' => 0,
                'created_at' => '2014-05-14 09:54:01',
                'updated_at' => '2024-06-27 21:02:31'
            ],
            [
                'id' => 2,
                'super_user' => 1,
                'email' => 'hello@halfshellstudios.co.uk',
                'password' => bcrypt('Password123'),
                'name' => 'Stuart Todd',
                'is_deleted' => 0,
                'created_at' => '2024-03-19 18:27:14',
                'updated_at' => '2024-03-19 18:29:26'
            ],
        ]);
    }
}
