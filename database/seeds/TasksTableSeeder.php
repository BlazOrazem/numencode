<?php

use Numencode\Models\Task;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        factory(Task::class, 30)->create();
    }
}
