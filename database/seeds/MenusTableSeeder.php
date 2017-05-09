<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => 1,
                'code'       => 'main',
                'title'      => 'Main Menu',
                'sort_order' => '10',
            ],
            [
                'id'         => 2,
                'code'       => 'sidebar',
                'title'      => 'Sidebar Menu',
                'sort_order' => '20',
            ],
        ];

        DB::table('menus')->insert($items);
    }
}
