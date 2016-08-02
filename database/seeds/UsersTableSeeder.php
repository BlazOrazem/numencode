<?php

use Numencode\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $items = [
            [
                'id' => '1',
                'name' => 'John Doe',
                'nickname' => 'JohnDoe',
                'email' => 'john@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'avatar_thumbnail' => $faker->imageUrl($width = 40, $height = 40, 'people'),
                'is_verified' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'Jane Doe',
                'nickname' => 'JaneDoe',
                'email' => 'jane@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'avatar_thumbnail' => $faker->imageUrl($width = 40, $height = 40, 'people'),
                'is_verified' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'name' => 'Jack Doe',
                'nickname' => 'JackDoe',
                'email' => 'jack@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'avatar_thumbnail' => $faker->imageUrl($width = 40, $height = 40, 'people'),
                'is_verified' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '4',
                'name' => 'Jill Doe',
                'nickname' => 'JillDoe',
                'email' => 'jill@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'avatar_thumbnail' => $faker->imageUrl($width = 40, $height = 40, 'people'),
                'is_verified' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('users')->insert($items);

        factory(User::class, 46)->create();
    }
}
