<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRightGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_right_groups')->insert([
            [
                'id' => 1,
                'group_name' => 'Administration Users',
                'icon_class' => 'fa fa-user',
                'ordering' => 1,
                'is_deleted' => false,
                'href' => route('administrators.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 2,
                'group_name' => 'Vendors',
                'icon_class' => 'fa fa-briefcase',
                'ordering' => 2,
                'is_deleted' => false,
                'href' => route('vendors.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 3,
                'group_name' => 'Products',
                'icon_class' => 'fa fa-cube',
                'ordering' => 3,
                'is_deleted' => false,
                'href' => route('products.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 4,
                'group_name' => 'Categories',
                'icon_class' => 'fa fa-tags',
                'ordering' => 4,
                'is_deleted' => false,
                'href' => route('categories.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 5,
                'group_name' => 'Services',
                'icon_class' => 'fa fa-wrench',
                'ordering' => 5,
                'is_deleted' => false,
                'href' => route('services.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 6,
                'group_name' => 'Rewards',
                'icon_class' => 'fa fa-gift',
                'ordering' => 6,
                'is_deleted' => false,
                'href' => route('rewards.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 7,
                'group_name' => 'Articles',
                'icon_class' => 'fa fa-book',
                'ordering' => 7,
                'is_deleted' => false,
                'href' => route('articles.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 8,
                'group_name' => 'Pages',
                'icon_class' => 'fa fa-copy',
                'ordering' => 8,
                'is_deleted' => false,
                'href' => route('pages.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
            [
                'id' => 9,
                'group_name' => 'Menus',
                'icon_class' => 'fa fa-bars',
                'ordering' => 9,
                'is_deleted' => false,
                'href' => route('menus.index'),
                'created_at' => '2017-10-18 14:54:31',
                'updated_at' => '2017-10-18 15:43:06',
            ],
        ]);
    }
}
