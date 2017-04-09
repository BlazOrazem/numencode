<?php

use Illuminate\Database\Seeder;

class CodelistTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => 1,
                'title'      => 'Page Layout',
                'sort_order' => '10',
            ],
            [
                'id'         => 2,
                'title'      => 'Content Position',
                'sort_order' => '20',
            ],
        ];

        DB::table('codelist_group')->insert($items);

        $items = [
            [
                'id'                => 1,
                'codelist_group_id' => 1,
                'code'              => 'default',
                'title'             => 'Default layout',
                'sort_order'        => '10',
            ],
            [
                'id'                => 2,
                'codelist_group_id' => 1,
                'code'              => 'contact',
                'title'             => 'Contact page',
                'sort_order'        => '20',
            ],
            [
                'id'                => 3,
                'codelist_group_id' => 2,
                'code'              => 'center',
                'title'             => 'Center',
                'sort_order'        => '10',
            ],
        ];

        DB::table('codelist_item')->insert($items);
    }
}
