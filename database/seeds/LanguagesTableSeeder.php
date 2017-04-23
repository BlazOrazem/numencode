<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => '1',
                'locale'     => 'en',
                'label'      => 'English',
                'is_default' => true,
                'sort_order' => 10,
                'is_hidden'  => null,
            ],
            [
                'id'         => '2',
                'locale'     => 'sl',
                'label'      => 'Slovenščina',
                'is_default' => null,
                'sort_order' => 20,
                'is_hidden'  => null,
            ],
        ];

        DB::table('languages')->insert($items);
    }
}
