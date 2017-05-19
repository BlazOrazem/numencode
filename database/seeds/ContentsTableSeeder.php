<?php

use Illuminate\Database\Seeder;
use Numencode\Models\Content\Content;

class ContentsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'            => 1,
                'page_id'       => null,
                'plugin_id'     => 4,
                'plugin_params' => null,
                'title'         => 'From our Blog',
                'lead'          => null,
                'body'          => null,
                'position'      => 'bottom',
                'sort_order'    => 10,
                'is_hidden'     => null,
            ],
            [
                'id'            => 2,
                'page_id'       => 1,
                'plugin_id'     => 1,
                'plugin_params' => null,
                'title'         => 'Task List',
                'lead'          => null,
                'body'          => null,
                'position'      => 'center',
                'sort_order'    => 10,
                'is_hidden'     => null,
            ],
            [
                'id'            => 3,
                'page_id'       => 2,
                'plugin_id'     => 2,
                'plugin_params' => null,
                'title'         => 'Random Task',
                'lead'          => null,
                'body'          => null,
                'position'      => 'center',
                'sort_order'    => 10,
                'is_hidden'     => null,
            ],
            [
                'id'            => 4,
                'page_id'       => 3,
                'plugin_id'     => 3,
                'plugin_params' => [
                    'task_id'    => '10',
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                ],
                'title'         => 'Specific Task',
                'lead'          => null,
                'body'          => null,
                'position'      => 'center',
                'sort_order'    => 10,
                'is_hidden'     => null,
            ],
            [
                'id'            => 5,
                'page_id'       => 10,
                'plugin_id'     => 5,
                'plugin_params' => [
                    'category_id' => '1',
                ],
                'title'         => null,
                'lead'          => null,
                'body'          => null,
                'position'      => 'center',
                'sort_order'    => 10,
                'is_hidden'     => null,
            ],
        ];

        foreach ($items as $item) {
            Content::forceCreate($item);
        }

        $translationContent = Content::find(1);
        $translationContent->saveTranslation('sl', [
            'title' => 'Iz našega bloga',
            'lead'  => null,
            'body'  => null,
        ]);

        $translationContent = Content::find(2);
        $translationContent->saveTranslation('sl', [
            'title' => 'Seznam opravil',
            'lead'  => null,
            'body'  => null,
        ]);

        $translationContent = Content::find(3);
        $translationContent->saveTranslation('sl', [
            'title' => 'Naključno opravilo',
            'lead'  => null,
            'body'  => null,
        ]);

        $translationContent = Content::find(4);
        $translationContent->saveTranslation('sl', [
            'title' => 'Specifično opravilo',
            'lead'  => null,
            'body'  => null,
        ]);

        $translationContent = Content::find(5);
        $translationContent->saveTranslation('sl', [
            'title' => null,
            'lead'  => null,
            'body'  => null,
        ]);
    }
}
