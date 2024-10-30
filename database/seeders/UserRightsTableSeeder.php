<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_rights')->insert([
            [
                'id' => 1,
                'right_name' => 'administrator',
                'right_display_name' => 'Manage Administration Users',
                'right_group_id' => 1,
                'icon_class' => 'fa fa-user',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 2,
                'right_name' => 'vendors',
                'right_display_name' => 'Manage Vendors',
                'right_group_id' => 2,
                'icon_class' => 'fa fa-briefcase',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 3,
                'right_name' => 'products',
                'right_display_name' => 'Manage Products',
                'right_group_id' => 3,
                'icon_class' => 'fa fa-cube',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 4,
                'right_name' => 'categories',
                'right_display_name' => 'Manage Categories',
                'right_group_id' => 4,
                'icon_class' => 'fa fa-tags',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 5,
                'right_name' => 'services',
                'right_display_name' => 'Manage Services',
                'right_group_id' => 5,
                'icon_class' => 'fa fa-wrench',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 6,
                'right_name' => 'rewards',
                'right_display_name' => 'Manage Rewards',
                'right_group_id' => 6,
                'icon_class' => 'fa fa-gift',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 7,
                'right_name' => 'articles',
                'right_display_name' => 'Manage Articles',
                'right_group_id' => 7,
                'icon_class' => 'fa fa-book',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 8,
                'right_name' => 'pages',
                'right_display_name' => 'Manage Website Pages',
                'right_group_id' => 8,
                'icon_class' => 'fa fa-copy',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
            [
                'id' => 9,
                'right_name' => 'menus',
                'right_display_name' => 'Manage Website Menus',
                'right_group_id' => 9,
                'icon_class' => 'fa fa-bars',
                'created_at' => '2017-10-18 14:55:49',
                'updated_at' => '2017-10-23 10:48:48',
                'is_deleted' => false,
            ],
        ]);
    }
}
