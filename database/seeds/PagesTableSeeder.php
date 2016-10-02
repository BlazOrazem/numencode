<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'parent_id' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 3,
                'parent_id' => null,
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 5,
                'parent_id' => 2,
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 6,
                'parent_id' => 2,
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 7,
                'parent_id' => 3,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 8,
                'parent_id' => 6,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => 9,
                'parent_id' => 6,
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],

        ];

        DB::table('pages')->insert($items);

        $items = [
            [
                'page_id' => 1,
                'locale' => 'en',
                'title' => 'Tasks list',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => 'Here is the task listing.',
            ],
            [
                'page_id' => 2,
                'locale' => 'en',
                'title' => 'About the company',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => 'This is about the company page.',
            ],
            [
                'page_id' => 3,
                'locale' => 'en',
                'title' => 'Contact',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => 'This is a contact page.',
            ],
            [
                'page_id' => 4,
                'locale' => 'en',
                'title' => 'About us',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
            ],
            [
                'page_id' => 5,
                'locale' => 'en',
                'title' => 'About the company',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
            ],
            [
                'page_id' => 6,
                'locale' => 'en',
                'title' => 'Our vision',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
            ],
            [
                'page_id' => 7,
                'locale' => 'en',
                'title' => 'Our location',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
            ],
            [
                'page_id' => 8,
                'locale' => 'en',
                'title' => 'History',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
            ],
            [
                'page_id' => 9,
                'locale' => 'en',
                'title' => 'Future',
                'lead' => 'Lorem ipsum dolor sit amar.',
                'body' => null,
            ],
        ];

        DB::table('pages_i18n')->insert($items);
    }
}
