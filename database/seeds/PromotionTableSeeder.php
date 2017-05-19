<?php

use Illuminate\Database\Seeder;
use Numencode\Models\Promotion\PromotionItem;
use Numencode\Models\Promotion\PromotionCategory;

class PromotionTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => 1,
                'title'      => 'Homepage promotions',
                'lead'       => null,
                'body'       => null,
                'sort_order' => '10',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        foreach ($items as $item) {
            PromotionCategory::forceCreate($item);
        }

        $translationPromotionCategory = PromotionCategory::find(1);
        $translationPromotionCategory->saveTranslation('sl', [
            'title' => 'Promocije na prvi strani',
            'lead'  => null,
            'body'  => null,
        ]);

        $items = [
            [
                'promotion_category_id' => 1,
                'title'                 => 'Numencode CMS',
                'lead'                  => 'check',
                'body'                  => "<p>Numencode is a web application, based on Laravel framework 5.4, that allows publishing, editing and modifying content, organizing, deleting as well as maintenance from a central interface.</p>",
                'link'                  => 'https://github.com/BlazOrazem/numencode',
                'sort_order'            => '10',
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime,
            ],
            [
                'promotion_category_id' => 1,
                'title'                 => 'Features',
                'lead'                  => 'gift',
                'body'                  => "<p>It is used to run websites containing pages, blogs, news, galleries, catalogs and shopping. Numencode is a stand-alone application to create, deploy, manage and store content on web pages.</p>",
                'link'                  => 'https://github.com/BlazOrazem/numencode',
                'sort_order'            => '20',
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime,
            ],
            [
                'promotion_category_id' => 1,
                'title'                 => 'Web Content',
                'lead'                  => 'info',
                'body'                  => "<p>Web content includes text and embedded graphics, photos, video, audio and code (e.g., for applications) that displays content or interacts with the user.</p>",
                'link'                  => 'https://github.com/BlazOrazem/numencode',
                'sort_order'            => '30',
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime,
            ],
        ];

        foreach ($items as $item) {
            PromotionItem::forceCreate($item);
        }

        $translationPromotionItem = PromotionItem::find(1);
        $translationPromotionItem->saveTranslation('sl', [
            'title' => 'Numencode CMS',
            'lead'  => 'check',
            'body'  => "<p>Numencode je spletna aplikacija, postavljena na Laravel 5.4 ogrodju, ki omogoča tako objavo, urejanje in spreminjanje vsebine, organizacijo, brisanje, kot tudi vzdrževanje s centralnega vmesnika.</p>",
            'link'  => 'https://github.com/BlazOrazem/numencode',
        ]);

        $translationPromotionItem = PromotionItem::find(2);
        $translationPromotionItem->saveTranslation('sl', [
            'title' => 'Lastnosti',
            'lead'  => 'gift',
            'body'  => "<p>Namen aplikacije je pogon spletnih strani, ki vsebujejo strani, blog, novice, galerije, katalog in nakupovanje. Numencode je samostojna aplikacija za kreiranje, objavo, urejanje in shranjevanje vsebine za spletno stran.</p>",
            'link'  => 'https://github.com/BlazOrazem/numencode',
        ]);

        $translationPromotionItem = PromotionItem::find(3);
        $translationPromotionItem->saveTranslation('sl', [
            'title' => 'Spletne Vsebine',
            'lead'  => 'info',
            'body'  => "<p>Spletne vsebine vključujejo besedila, grafike, slike, video posnetke, avdio datoteke, izseke izvorne kode (npr. za prikaz dela kode neke aplikacije), ki se prikazujejo na strani ali omogočajo interakcijo z uporabnikom.</p>",
            'link'  => 'https://github.com/BlazOrazem/numencode',
        ]);
    }
}
