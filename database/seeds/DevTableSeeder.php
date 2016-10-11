<?php

use Illuminate\Database\Seeder;

class DevTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'locale' => 'en',
                'uri' => 'new-page',
                'action' => 'PageController@index',
                'params' => '{"id":1}',
            ],
        ];

        DB::table('routes')->insert($items);
    }
}
