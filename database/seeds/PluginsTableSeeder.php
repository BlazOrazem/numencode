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
                'controller' => 'Task',
                'method' => 'index',
                'ord' => 10,
                'is_hidden' => 0,
            ],
            [
                'id' => 2,
                'title' => 'Sample',
                'description' => null,
                'controller' => 'Task',
                'method' => 'sample',
                'ord' => 20,
                'is_hidden' => 0,
            ],
            [
                'id' => 3,
                'title' => 'Text',
                'description' => 'Just some text content.',
                'controller' => null,
                'method' => null,
                'ord' => 30,
                'is_hidden' => 0,
            ],
        ];

        DB::table('plugins')->insert($items);
    }
}
