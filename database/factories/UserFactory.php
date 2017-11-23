<?php

use Faker\Generator as Faker;

$factory->define(Numencode\Models\User\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'nickname'       => $faker->name,
        'email'          => $faker->email,
        'password'       => $password ?: $password = bcrypt(str_random(10)),
        'avatar'         => '/uploads/sample0' . rand(1, 3) . '_600x600.jpg',
        'is_verified'    => true,
        'token'          => str_random(30),
        'remember_token' => str_random(10),
    ];
});
