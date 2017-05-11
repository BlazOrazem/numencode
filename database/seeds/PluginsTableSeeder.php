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
                'title'       => 'Tasks list',
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
//            [
//                'id'          => 2,
//                'title'       => 'Show Task',
//                'description' => null,
//                'action'      => 'TaskController@show',
//                'params'      => [
//                                    [
//                                        'label' => 'First name',
//                                        'name'  => 'first_name',
//                                        'type'  => 'text',
//                                    ],
//                                    [
//                                        'label' => 'Last name',
//                                        'name'  => 'last_name',
//                                        'type'  => 'text',
//                                    ],
//                                    [
//                                        'label'   => 'Task',
//                                        'name'    => 'task_id',
//                                        'type'    => 'select',
//                                        'options' => 'Task@getTaskSelection',
//                                    ],
//                                ],
//                'sort_order'  => 20,
//                'is_hidden'   => null,
//            ],
//            [
//                'id'          => 3,
//                'title'       => 'Show Task',
//                'description' => null,
//                'action'      => 'TaskController@show',
//                'params'      => [
//                                    [
//                                        'label' => 'First name',
//                                        'name'  => 'first_name',
//                                        'type'  => 'text',
//                                    ],
//                                    [
//                                        'label' => 'Last name',
//                                        'name'  => 'last_name',
//                                        'type'  => 'text',
//                                    ],
//                                    [
//                                        'label'   => 'Task',
//                                        'name'    => 'task_id',
//                                        'type'    => 'radio',
//                                        'options' => 'Task@getTaskSelection',
//                                    ],
//                                ],
//                'sort_order'  => 30,
//                'is_hidden'   => null,
//            ],
//            [
//                'id'          => 4,
//                'title'       => 'Show Task',
//                'description' => null,
//                'action'      => 'TaskController@show',
//                'params'      => [
//                                    [
//                                        'label' => 'First name',
//                                        'name'  => 'first_name',
//                                        'type'  => 'text',
//                                    ],
//                                    [
//                                        'label' => 'Last name',
//                                        'name'  => 'last_name',
//                                        'type'  => 'text',
//                                    ],
//                                    [
//                                        'label'   => 'Task',
//                                        'name'    => 'task_id',
//                                        'type'    => 'checkbox',
//                                        'options' => 'Task@getTaskSelection',
//                                    ],
//                                ],
//                'sort_order'  => 40,
//                'is_hidden'   => null,
//            ],
        ];

        foreach ($items as $item) {
            Plugin::forceCreate($item);
        }
    }
}
