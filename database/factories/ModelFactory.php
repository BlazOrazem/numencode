<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(Numencode\Models\User\Manager::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'phone'          => $faker->phoneNumber,
        'avatar'         => '/uploads/sample0' . rand(1, 3) . '_600x600.jpg',
        'tasks'          => null,
        'remember_token' => str_random(10),
    ];
});

$factory->define(Numencode\Models\User\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'nickname'       => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'avatar'         => '/uploads/sample0' . rand(1, 3) . '_600x600.jpg',
        'is_verified'    => true,
        'token'          => str_random(30),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Numencode\Models\Task::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(4),
        'body'  => $faker->paragraph,
    ];
});
