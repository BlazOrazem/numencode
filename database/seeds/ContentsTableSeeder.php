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
                'lead' => null,
                'body' => null,
                'position' => 'center',
                'ord' => 10,
                'is_hidden' => 0,
            ],
            [
                'id' => 2,
                'page_id' => 1,
                'plugin_id' => 2,
                'plugin_params' => '{\"id\":10,\"name\":\"John\",\"surname\":\"Doe\"}',
                'title' => 'Sample plugin',
                'lead' => null,
                'body' => null,
                'position' => 'center',
                'ord' => 20,
                'is_hidden' => 0,
            ],
            [
                'id' => 3,
                'page_id' => 1,
                'plugin_id' => null,
                'plugin_params' => null,
                'title' => 'Some text here',
                'lead' => 'This is a content with some sample text.',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in erat at enim egestas mattis sit amet mattis diam. Aliquam eu blandit sem. Fusce eget lobortis metus. Vestibulum laoreet magna at tellus eleifend convallis. Maecenas ac tristique magna. Aliquam tincidunt arcu sed quam rutrum, sit amet placerat tellus efficitur. Morbi semper libero augue, eget sodales nisi volutpat ut. Cras tincidunt libero id mi varius, ac ultrices nibh placerat. Vivamus porttitor dictum nisl a sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper sem augue, vel euismod orci convallis non. Sed nisl mauris, blandit eu finibus sed, tempor eget velit. Proin feugiat elementum felis, non viverra dui ornare at.',
                'position' => 'center',
                'ord' => 30,
                'is_hidden' => 0,
            ],
        ];

        foreach ($items as $item) {
            Content::forceCreate($item);
        }
    }
}
