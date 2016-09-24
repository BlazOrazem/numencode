<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'title' => 'Tasks list',
                'controller' => 'Task',
                'method' => 'index',
            ],
            [
                'id' => '2',
                'title' => 'Sample',
                'controller' => 'Task',
                'method' => 'sample',
            ],
        ];

        DB::table('contents')->insert($items);
    }
}
