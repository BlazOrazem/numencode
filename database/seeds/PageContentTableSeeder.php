<?php

use Illuminate\Database\Seeder;

class PageContentTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'page_id' => 1,
                'content_id' => 1,
                'params' => null,
                'ord' => 20,
                'is_hidden' => 0,
            ],
            [
                'page_id' => 1,
                'content_id' => 2,
                'params' => '{"id":10,"name":"John","surname":"Doe"}',
                'ord' => 10,
                'is_hidden' => 0,
            ],
        ];

        DB::table('page_content')->insert($items);
    }
}
