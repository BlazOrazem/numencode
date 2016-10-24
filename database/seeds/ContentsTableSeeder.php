<?php

use Numencode\Models\Content;
use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'page_id' => 1,
                'plugin_id' => 1,
                'plugin_params' => null,
                'title' => 'Task list plugin',
                'lead' => 'Eng lead lorem ipsum.',
                'body' => 'EN Non viverra dui ornare at.',
                'position' => 'center',
                'ord' => 10,
                'is_hidden' => NULL,
            ],
            [
                'id' => 2,
                'page_id' => 1,
                'plugin_id' => 2,
                'plugin_params' => (object)['id' => 10, 'name' => 'John', 'surname' => 'Doe'],
                'title' => 'Sample plugin',
                'lead' => 'Eng lead lorem ipsum.',
                'body' => 'EN Lorem ipsum dolor sit amet.',
                'position' => 'center',
                'ord' => 20,
                'is_hidden' => NULL,
            ],
            [
                'id' => 3,
                'page_id' => 1,
                'plugin_id' => null,
                'plugin_params' => null,
                'title' => 'Some text here',
                'lead' => 'This is a content with some sample text.',
                'body' => 'EN Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in erat at enim egestas mattis sit amet mattis diam. Aliquam eu blandit sem. Fusce eget lobortis metus. Vestibulum laoreet magna at tellus eleifend convallis. Maecenas ac tristique magna. Aliquam tincidunt arcu sed quam rutrum, sit amet placerat tellus efficitur. Morbi semper libero augue, eget sodales nisi volutpat ut. Cras tincidunt libero id mi varius, ac ultrices nibh placerat. Vivamus porttitor dictum nisl a sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper sem augue, vel euismod orci convallis non. Sed nisl mauris, blandit eu finibus sed, tempor eget velit. Proin feugiat elementum felis, non viverra dui ornare at.',
                'position' => 'center',
                'ord' => 30,
                'is_hidden' => NULL,
            ],
        ];

        foreach ($items as $item) {
            Content::forceCreate($item);
        }

        $translationContent = Content::find(1);
        $translationContent->saveTranslation('sl', [
            'title' => 'Seznam opravil plugin',
            'lead' => 'Slo lead lorem ipsum.',
            'body' => 'SL Non viverra dui ornare at.',
        ]);

        $translationContent = Content::find(2);
        $translationContent->saveTranslation('sl', [
            'title' => 'Testni plugin',
            'lead' => 'Slo lead lorem ipsum.',
            'body' => 'SL Lorem ipsum dolor sit amet.',
        ]);

        $translationContent = Content::find(3);
        $translationContent->saveTranslation('sl', [
            'title' => 'Nekaj besedila tukaj',
            'lead' => 'To je vsebina s testnim besedilom.',
            'body' => 'SL Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in erat at enim egestas mattis sit amet mattis diam. Aliquam eu blandit sem. Fusce eget lobortis metus. Vestibulum laoreet magna at tellus eleifend convallis. Maecenas ac tristique magna. Aliquam tincidunt arcu sed quam rutrum, sit amet placerat tellus efficitur. Morbi semper libero augue, eget sodales nisi volutpat ut. Cras tincidunt libero id mi varius, ac ultrices nibh placerat. Vivamus porttitor dictum nisl a sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper sem augue, vel euismod orci convallis non. Sed nisl mauris, blandit eu finibus sed, tempor eget velit. Proin feugiat elementum felis, non viverra dui ornare at.',
        ]);
    }
}
