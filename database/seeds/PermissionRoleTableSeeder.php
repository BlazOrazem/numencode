<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['permission_id' => '1', 'role_id' => '1'],
            ['permission_id' => '1', 'role_id' => '2'],
            ['permission_id' => '1', 'role_id' => '3'],
            ['permission_id' => '1', 'role_id' => '4'],
            ['permission_id' => '2', 'role_id' => '2'],
            ['permission_id' => '2', 'role_id' => '3'],
            ['permission_id' => '2', 'role_id' => '4'],
            ['permission_id' => '3', 'role_id' => '2'],
            ['permission_id' => '3', 'role_id' => '3'],
            ['permission_id' => '3', 'role_id' => '4'],
            ['permission_id' => '4', 'role_id' => '3'],
            ['permission_id' => '4', 'role_id' => '4'],
            ['permission_id' => '5', 'role_id' => '4'],
            ['permission_id' => '6', 'role_id' => '4'],
        ];

        DB::table('permission_role')->insert($items);
    }
}
