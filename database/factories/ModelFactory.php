<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Admin\Models\Manager::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'phone' => $faker->phoneNumber,
        'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Admin\Models\Task::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(4),
        'body' => $faker->paragraph,
    ];
});

$factory->define(Cms\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'nickname' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
        'avatar_thumbnail' => $faker->imageUrl($width = 40, $height = 40, 'people'),
        'is_verified' => true,
        'token' => str_random(30),
        'remember_token' => str_random(10),
    ];
});
