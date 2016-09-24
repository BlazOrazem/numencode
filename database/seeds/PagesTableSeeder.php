<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'title' => 'Tasks list',
                'body' => 'Here is the task listing.',
                'ord' => 10,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'title' => 'About the company',
                'body' => 'This is about the company page.',
                'ord' => 20,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'title' => 'Contact',
                'body' => 'This is a contact page.',
                'ord' => 30,
                'is_hidden' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('pages')->insert($items);
    }
}
