<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'name' => 'view_managers',
                'label' => 'Admin can view all managers.',
                'sort_order' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'create_managers',
                'label' => 'Admin can create new managers.',
                'sort_order' => 20,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'name' => 'edit_managers',
                'label' => 'Admin can edit managers.',
                'sort_order' => 30,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '4',
                'name' => 'delete_managers',
                'label' => 'Admin can delete managers.',
                'sort_order' => 40,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '5',
                'name' => 'manage_profile',
                'label' => 'User can manage their own profile.',
                'sort_order' => 100,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '6',
                'name' => 'write_posts',
                'label' => 'User can write their own posts.',
                'sort_order' => 110,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '7',
                'name' => 'manage_posts',
                'label' => 'User can manage their own posts.',
                'sort_order' => 120,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '8',
                'name' => 'publish_posts',
                'label' => 'User can publish their own posts.',
                'sort_order' => 130,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '9',
                'name' => 'manage_all_posts',
                'label' => 'User can manage posts of other users.',
                'sort_order' => 140,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '10',
                'name' => 'publish_all_posts',
                'label' => 'User can publish posts of other users.',
                'sort_order' => 150,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('permissions')->insert($items);
    }
}
