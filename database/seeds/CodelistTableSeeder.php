<?php

use Illuminate\Database\Seeder;

class CodelistTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'title' => 'Page Layout',
                'ord' => '10',
            ],
        ];

        DB::table('codelist_group')->insert($items);

        $items = [
            [
                'id' => 1,
                'codelist_group_id' => 1,
                'code' => 'default',
                'title' => 'Default layout',
                'ord' => '10',
            ],
            [
                'id' => 2,
                'codelist_group_id' => 1,
                'code' => 'contact',
                'title' => 'Contact page',
                'ord' => '20',
            ],
        ];

        DB::table('codelist_item')->insert($items);
    }
}
