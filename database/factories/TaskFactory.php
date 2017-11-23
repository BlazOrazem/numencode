<?php

use Faker\Generator as Faker;

$factory->define(Numencode\Models\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'body'  => $faker->paragraph,
    ];
});
