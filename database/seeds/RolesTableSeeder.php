<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => '1',
                'name'       => 'administrator',
                'label'      => 'Full admin control',
                'is_admin'   => true,
                'sort_order' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '2',
                'name'       => 'manager',
                'label'      => 'Limited admin control',
                'is_admin'   => true,
                'sort_order' => 20,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '3',
                'name'       => 'subscriber',
                'label'      => 'Can only manage their profile',
                'is_admin'   => false,
                'sort_order' => 30,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '4',
                'name'       => 'contributor',
                'label'      => 'Can write comments on blog posts',
                'is_admin'   => false,
                'sort_order' => 40,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('roles')->insert($items);
    }
}
