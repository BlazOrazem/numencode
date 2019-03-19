<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Numencode\Models\User\User;

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'nickname'       => $faker->name,
        'email'          => $faker->email,
        'password'       => $password ?: $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'avatar'         => '/uploads/sample0' . rand(1, 3) . '_600x600.jpg',
        'is_verified'    => true,
        'token'          => Str::random(30),
        'remember_token' => Str::random(10),
    ];
});
