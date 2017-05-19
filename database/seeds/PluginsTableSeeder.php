<?php

use Illuminate\Database\Seeder;
use Numencode\Models\Content\Plugin;

class PluginsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'          => 1,
                'title'       => 'Tasks List',
                'description' => 'Display a list of all tasks',
                'action'      => 'TaskController@index',
                'params'      => null,
                'sort_order'  => 10,
                'is_hidden'   => null,
            ],
            [
                'id'          => 2,
                'title'       => 'Random Task',
                'description' => 'Display a random Task',
                'action'      => 'TaskController@random',
                'params'      => null,
                'sort_order'  => 20,
                'is_hidden'   => null,
            ],
            [
                'id'          => 3,
                'title'       => 'Specific Task',
                'description' => 'Display a specific Task with attributes',
                'action'      => 'TaskController@show',
                'params'      => [
                    [
                        'label' => 'First name',
                        'name'  => 'first_name',
                        'type'  => 'text',
                    ],
                    [
                        'label' => 'Last name',
                        'name'  => 'last_name',
                        'type'  => 'text',
                    ],
                    [
                        'label'   => 'Task',
                        'name'    => 'task_id',
                        'type'    => 'select',
                        'options' => 'Task@getTaskSelection',
                    ],
                ],
                'sort_order'  => 30,
                'is_hidden'   => null,
            ],
            [
                'id'          => 4,
                'title'       => 'Random Blog Entry',
                'description' => 'Display a random blog entry',
                'action'      => 'BlogController@random',
                'params'      => null,
                'sort_order'  => 40,
                'is_hidden'   => null,
            ],
            [
                'id'          => 5,
                'title'       => 'Blog category',
                'description' => 'Display a blog category',
                'action'      => 'BlogController@category',
                'params'      => [
                    [
                        'label'   => 'Category',
                        'name'    => 'category_id',
                        'type'    => 'select',
                        'options' => 'Blog\\BlogCategory@getSelection',
                    ],
                ],
                'sort_order'  => 50,
                'is_hidden'   => null,
            ],
        ];

        foreach ($items as $item) {
            Plugin::forceCreate($item);
        }
    }
}
