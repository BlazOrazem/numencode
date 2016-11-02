<?php

use Illuminate\Database\Seeder;

class PluginsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'title' => 'Tasks list',
                'description' => null,
                'action' => 'TaskController@index',
                'sort_order' => 10,
                'is_hidden' => 0,
            ],
            [
                'id' => 2,
                'title' => 'Sample',
                'description' => null,
                'action' => 'TaskController@sample',
                'sort_order' => 20,
                'is_hidden' => 0,
            ],
        ];

        DB::table('plugins')->insert($items);
    }
}
