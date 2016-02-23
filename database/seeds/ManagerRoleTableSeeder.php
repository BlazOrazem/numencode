<?php

use Illuminate\Database\Seeder;

class ManagerRoleTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['role_id' => '1', 'manager_id' => '1'],
            ['role_id' => '2', 'manager_id' => '2'],
        ];

        DB::table('manager_role')->insert($items);
    }
}
