<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $items = [
            ['id' => '1', 'name' => 'John Doe', 'nickname' => 'JohnDoe', 'email' => 'john@numencode.com', 'password' =>'$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '2', 'name' => 'Jane Doe', 'nickname' => 'JaneDoe', 'email' => 'jane@numencode.com', 'password' =>'$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '3', 'name' => 'Jack Doe', 'nickname' => 'JackDoe', 'email' => 'jack@numencode.com', 'password' =>'$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ];

        DB::table('users')->insert($items);
    }

}