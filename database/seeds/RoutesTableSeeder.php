<?php

use Illuminate\Database\Seeder;
use Numencode\Models\System\Url;

class RoutesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'     => '1',
                'action' => 'PageController@index',
                'uri'    => 'new-page',
                'params' => (object) ['id' => 1],
            ],
            [
                'id'     => '2',
                'action' => 'PageController@index',
                'uri'    => 'about-the-company',
                'params' => (object) ['id' => 2],
            ],
            [
                'id'     => '3',
                'action' => 'PageController@index',
                'uri'    => 'contact',
                'params' => (object) ['id' => 3],
            ],
            [
                'id'     => '4',
                'action' => 'PageController@index',
                'uri'    => 'about-us',
                'params' => (object) ['id' => 4],
            ],
        ];

        foreach ($items as $item) {
            Url::forceCreate($item);
        }

        $translationContent = Url::find(1);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/nova-stran',
            'params' => (object) ['id' => 1],
        ]);

        $translationContent = Url::find(2);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/o-podjetju',
            'params' => (object) ['id' => 2],
        ]);

        $translationContent = Url::find(3);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/kontakt',
            'params' => (object) ['id' => 3],
        ]);

        $translationContent = Url::find(4);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/o-nas',
            'params' => (object) ['id' => 4],
        ]);
    }
}
