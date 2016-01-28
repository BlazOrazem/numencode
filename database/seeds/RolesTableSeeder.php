<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'name' => 'subscriber',
                'label' => 'Subscriber - can only manage their profile.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'contributor',
                'label' => 'Contributor - can write and manage their own posts but cannot publish them.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'name' => 'author',
                'label' => 'Author - can publish and manage their own posts.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '4',
                'name' => 'editor',
                'label' => 'Editor - can publish and manage posts including the posts of other users.',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('roles')->insert($items);
    }
}
