<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Numencode\Models\User\Manager;

$factory->define(Manager::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => $password ?: $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone'          => $faker->phoneNumber,
        'avatar'         => '/uploads/sample0' . rand(1, 3) . '_600x600.jpg',
        'tasks'          => null,
        'remember_token' => Str::random(10),
    ];
});
