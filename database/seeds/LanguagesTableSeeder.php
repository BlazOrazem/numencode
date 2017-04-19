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
            ],
            [
                'id'         => '2',
                'locale'     => 'sl',
                'label'      => 'Slovenščina',
            ],
        ];

        DB::table('languages')->insert($items);
    }
}
