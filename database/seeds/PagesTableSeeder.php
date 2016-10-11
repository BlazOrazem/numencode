<?php

use Numencode\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'parent_id' => null,
                'route_id' => 1,
                'title' => 'Tasks list',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => 'Here is the task listing.',
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'route_id' => null,
                'title' => 'About the company',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => 'This is about the company page.',
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 3,
                'parent_id' => null,
                'route_id' => null,
                'title' => 'Contact',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => 'This is a contact page.',
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'route_id' => null,
                'title' => 'About us',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 5,
                'parent_id' => 2,
                'route_id' => null,
                'title' => 'About the company',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 6,
                'parent_id' => 2,
                'route_id' => null,
                'title' => 'Our vision',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 7,
                'parent_id' => 3,
                'route_id' => null,
                'title' => 'Our location',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 8,
                'parent_id' => 6,
                'route_id' => null,
                'title' => 'History',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 9,
                'parent_id' => 6,
                'route_id' => null,
                'title' => 'Future',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
                'ord' => 20,
                'is_hidden' => 0,
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
            'lead' => 'To je slovenska stran.',
            'body' => 'Tukaj je seznam opravil.',
        ]);
    }
}
