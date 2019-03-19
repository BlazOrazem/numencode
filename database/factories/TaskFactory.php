<?php

use Numencode\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'body'  => $faker->paragraph,
    ];
});
