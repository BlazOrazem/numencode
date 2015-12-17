<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => '1',
                'name' => 'John Doe',
                'nickname' => 'JohnDoe',
                'email' => 'john@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
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
                'is_verified' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('users')->insert($items);
    }
}
