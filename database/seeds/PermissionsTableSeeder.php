<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'name' => 'manage_profile',
                'label' => 'User can manage their own profile.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'write_posts',
                'label' => 'User can write their own posts.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'name' => 'manage_posts',
                'label' => 'User can manage their own posts.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '4',
                'name' => 'publish_posts',
                'label' => 'User can publish their own posts.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '5',
                'name' => 'manage_all_posts',
                'label' => 'User can manage posts of other users.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '6',
                'name' => 'publish_all_posts',
                'label' => 'User can publish posts of other users.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('permissions')->insert($items);
    }
}
