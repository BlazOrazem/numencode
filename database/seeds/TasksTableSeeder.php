<?php

use Numencode\Models\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        factory(Task::class, 50)->create();
    }
}
