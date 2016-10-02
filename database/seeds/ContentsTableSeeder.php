<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'page_id' => 1,
                'plugin_id' => 1,
                'plugin_params' => null,
                'ord' => 10,
                'is_hidden' => 0,
            ],
            [
                'id' => 2,
                'page_id' => 1,
                'plugin_id' => 3,
                'plugin_params' => null,
                'ord' => 20,
                'is_hidden' => 0,
            ],
            [
                'id' => 3,
                'page_id' => 1,
                'plugin_id' => 2,
                'plugin_params' => null,
                'ord' => 30,
                'is_hidden' => 0,
            ],
        ];

        DB::table('contents')->insert($items);

        $items = [
            [
                'content_id' => 1,
                'locale' => 'en',
                'title' => 'Task',
                'lead' => 'Task',
                'body' => 'Task',
            ],
            [
                'content_id' => 2,
                'locale' => 'en',
                'title' => null,
                'lead' => null,
                'body' => null,
            ],
            [
                'content_id' => 3,
                'locale' => 'en',
                'title' => null,
                'lead' => null,
                'body' => null,
            ],
        ];

        DB::table('contents_i18n')->insert($items);
    }
}
