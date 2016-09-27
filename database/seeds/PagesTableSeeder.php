<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'parent_id' => null,
                'title' => 'Tasks list',
                'body' => 'Here is the task listing.',
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'parent_id' => null,
                'title' => 'About the company',
                'body' => 'This is about the company page.',
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'parent_id' => null,
                'title' => 'Contact',
                'body' => 'This is a contact page.',
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '4',
                'parent_id' => 2,
                'title' => 'About us',
                'body' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '5',
                'parent_id' => 2,
                'title' => 'About the company',
                'body' => null,
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '6',
                'parent_id' => 2,
                'title' => 'Our vision',
                'body' => null,
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '7',
                'parent_id' => 3,
                'title' => 'Our location',
                'body' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '8',
                'parent_id' => 6,
                'title' => 'History',
                'body' => null,
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '9',
                'parent_id' => 6,
                'title' => 'Future',
                'body' => null,
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],

        ];

        DB::table('pages')->insert($items);
    }
}
