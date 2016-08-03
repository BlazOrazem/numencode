<?php

use Illuminate\Database\Seeder;

class RoleManagerTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['role_id' => '1', 'manager_id' => '1'],
            ['role_id' => '2', 'manager_id' => '2'],
        ];

        DB::table('role_manager')->insert($items);
    }
}
