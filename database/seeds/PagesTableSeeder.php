<?php

use Numencode\Models\Page\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => 1,
                'parent_id'  => null,
                'route_id'   => 1,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Tasks list',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => 'Here is the task listing.',
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 2,
                'parent_id'  => null,
                'route_id'   => 2,
                'menu'       => 'main',
                'layout'     => 'contact',
                'title'      => 'About the company',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => 'This is about the company page.',
                'sort_order' => 20,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 3,
                'parent_id'  => null,
                'route_id'   => 3,
                'menu'       => 'corpo',
                'layout'     => 'default',
                'title'      => 'Contact',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => 'This is a contact page.',
                'sort_order' => 30,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 4,
                'parent_id'  => 2,
                'route_id'   => 4,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'About us',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => null,
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 5,
                'parent_id'  => 2,
                'route_id'   => null,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'About the company',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => null,
                'sort_order' => 20,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 6,
                'parent_id'  => 2,
                'route_id'   => null,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Our vision',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => null,
                'sort_order' => 30,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 7,
                'parent_id'  => 3,
                'route_id'   => null,
                'menu'       => 'corpo',
                'layout'     => 'default',
                'title'      => 'Our location',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => null,
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 8,
                'parent_id'  => 6,
                'route_id'   => null,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'History',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => null,
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 9,
                'parent_id'  => 6,
                'route_id'   => null,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Future',
                'lead'       => 'Lorem ipsum dolor sit amar.',
                'body'       => null,
                'sort_order' => 20,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        foreach ($items as $item) {
            Page::forceCreate($item);
        }

        $translationPage = Page::find(1);
        $translationPage->saveTranslation('sl', [
            'title' => 'Seznam opravil',
            'lead'  => 'To je slovenska stran.',
            'body'  => 'Tukaj je seznam opravil.',
        ]);

        $translationPage = Page::find(2);
        $translationPage->saveTranslation('sl', [
            'title' => 'O podjetju',
            'lead'  => 'To je stran o podjetju.',
            'body'  => 'Tukaj bo zemljevid in kontakt.',
        ]);
    }
}
