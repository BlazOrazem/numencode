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
                'uri'    => 'tasks-list',
                'params' => (object) ['id' => 1],
            ],
            [
                'id'     => '2',
                'action' => 'PageController@index',
                'uri'    => 'random-task',
                'params' => (object) ['id' => 2],
            ],
            [
                'id'     => '3',
                'action' => 'PageController@index',
                'uri'    => 'specific-task',
                'params' => (object) ['id' => 3],
            ],
            [
                'id'     => '4',
                'action' => 'PageController@index',
                'uri'    => 'company',
                'params' => (object) ['id' => 4],
            ],
            [
                'id'     => '5',
                'action' => 'PageController@index',
                'uri'    => 'our-services',
                'params' => (object) ['id' => 5],
            ],
            [
                'id'     => '6',
                'action' => 'PageController@index',
                'uri'    => 'qualifications',
                'params' => (object) ['id' => 6],
            ],
            [
                'id'     => '7',
                'action' => 'PageController@index',
                'uri'    => 'contact',
                'params' => (object) ['id' => 7],
            ],
            [
                'id'     => '8',
                'action' => 'PageController@index',
                'uri'    => 'our-location',
                'params' => (object) ['id' => 8],
            ],
            [
                'id'     => '9',
                'action' => 'PageController@index',
                'uri'    => 'contact-us',
                'params' => (object) ['id' => 9],
            ],
            [
                'id'     => '10',
                'action' => 'BlogController@index',
                'uri'    => 'news',
                'params' => (object) ['id' => 1],
            ],
            [
                'id'     => '11',
                'action' => 'BlogController@show',
                'uri'    => 'free-financial-workshops',
                'params' => (object) ['id' => 1],
            ],
        ];

        foreach ($items as $item) {
            Url::forceCreate($item);
        }

        $translationContent = Url::find(1);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/seznam-opravil',
            'params' => (object) ['id' => 1],
        ]);

        $translationContent = Url::find(2);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/nakljucno-opravilo',
            'params' => (object) ['id' => 2],
        ]);

        $translationContent = Url::find(3);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/specificno-opravilo',
            'params' => (object) ['id' => 3],
        ]);

        $translationContent = Url::find(4);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/o-podjetju',
            'params' => (object) ['id' => 4],
        ]);

        $translationContent = Url::find(5);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/nase-storitve',
            'params' => (object) ['id' => 5],
        ]);

        $translationContent = Url::find(6);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/kvalifikacije',
            'params' => (object) ['id' => 6],
        ]);

        $translationContent = Url::find(7);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/kontakt',
            'params' => (object) ['id' => 7],
        ]);

        $translationContent = Url::find(8);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/kje-se-nahajamo',
            'params' => (object) ['id' => 8],
        ]);

        $translationContent = Url::find(9);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/pisite-nam',
            'params' => (object) ['id' => 9],
        ]);

        $translationContent = Url::find(10);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/novice',
            'params' => (object) ['id' => 1],
        ]);

        $translationContent = Url::find(11);
        $translationContent->saveTranslation('sl', [
            'uri'    => 'sl/brezplacne-financne-delavnice',
            'params' => (object) ['id' => 1],
        ]);
    }
}
