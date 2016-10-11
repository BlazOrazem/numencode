<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'uri' => 'new-page',
                'action' => 'PageController@index',
                'params' => '{"id":1}',
            ],
            [
                'id' => '2',
                'uri' => 'sl/nova-stran',
                'action' => 'PageController@index',
                'params' => '{"id":1}',
            ],
        ];

        DB::table('routes')->insert($items);
    }
}
