<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'code' => 'main',
                'title' => 'Main Menu',
                'ord' => '10',
            ],
            [
                'id' => 2,
                'code' => 'corpo',
                'title' => 'Corpo Menu',
                'ord' => '20',
            ],
        ];

        DB::table('menus')->insert($items);
    }
}
