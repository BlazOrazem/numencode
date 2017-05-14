<?php

use Illuminate\Database\Seeder;

class CodelistTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => 1,
                'code'       => 'dictionary_group',
                'title'      => 'Dictionary Group',
                'sort_order' => '10',
            ],
            [
                'id'         => 2,
                'code'       => 'page_layout',
                'title'      => 'Page Layout',
                'sort_order' => '20',
            ],
            [
                'id'         => 3,
                'code'       => 'content_position',
                'title'      => 'Content Position',
                'sort_order' => '30',
            ],
        ];

        DB::table('codelist_group')->insert($items);

        $items = [
            [
                'id'                => 1,
                'codelist_group_id' => 2,
                'code'              => 'default',
                'title'             => 'Default layout',
                'sort_order'        => '10',
            ],
            [
                'id'                => 2,
                'codelist_group_id' => 2,
                'code'              => 'map',
                'title'             => 'Google map',
                'sort_order'        => '20',
            ],
            [
                'id'                => 3,
                'codelist_group_id' => 2,
                'code'              => 'contact',
                'title'             => 'Contact page',
                'sort_order'        => '30',
            ],
            [
                'id'                => 4,
                'codelist_group_id' => 3,
                'code'              => 'center',
                'title'             => 'Center',
                'sort_order'        => '10',
            ],
            [
                'id'                => 5,
                'codelist_group_id' => 3,
                'code'              => 'bottom',
                'title'             => 'Bottom',
                'sort_order'        => '20',
            ],
        ];

        DB::table('codelist_item')->insert($items);
    }
}
