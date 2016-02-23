<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'name' => 'administrator',
                'label' => 'Administrator - full admin control.',
                'is_admin' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'manager',
                'label' => 'Manager - limited admin control.',
                'is_admin' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'name' => 'subscriber',
                'label' => 'Subscriber - can only manage their profile.',
                'is_admin' => false,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '4',
                'name' => 'contributor',
                'label' => 'Contributor - can write and manage their own posts but cannot publish them.',
                'is_admin' => false,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '5',
                'name' => 'author',
                'label' => 'Author - can publish and manage their own posts.',
                'is_admin' => false,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '6',
                'name' => 'editor',
                'label' => 'Editor - can publish and manage posts including the posts of other users.',
                'is_admin' => false,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('roles')->insert($items);
    }
}
