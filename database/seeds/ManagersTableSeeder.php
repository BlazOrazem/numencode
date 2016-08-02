<?php

use Faker\Factory as Faker;
use Numencode\Models\Manager;
use Illuminate\Database\Seeder;

class ManagersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $items = [
            [
                'id' => '1',
                'name' => 'Admin Developer',
                'email' => 'info@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'Manager Developer',
                'email' => 'dev@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl($width = 640, $height = 480, 'people'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('managers')->insert($items);

        factory(Manager::class, 8)->create();
    }
}
