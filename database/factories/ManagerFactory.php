<?php

use Faker\Generator as Faker;

$factory->define(Numencode\Models\User\Manager::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => $password ?: $password = bcrypt(str_random(10)),
        'phone'          => $faker->phoneNumber,
        'avatar'         => '/uploads/sample0' . rand(1, 3) . '_600x600.jpg',
        'tasks'          => null,
        'remember_token' => str_random(10),
    ];
});
