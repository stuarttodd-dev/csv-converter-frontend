<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAssignedRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_assigned_rights')->insert([
            [
                'id' => 1,
                'right_id' => 1,
                'user_id' => 1,
                'created_at' => '2017-10-23 14:30:10',
                'updated_at' => '2017-10-23 14:30:10',
                'is_deleted' => 0
            ],
            [
                'id' => 2,
                'right_id' => 1,
                'user_id' => 2,
                'created_at' => '2017-10-23 14:30:10',
                'updated_at' => '2017-10-23 14:30:10',
                'is_deleted' => 0
            ],
        ]);
    }
}
