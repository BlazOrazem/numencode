<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Database tables.
     *
     * @var array
     */
    private $tables = [
        'users',
        'roles',
        'permissions',
        'permission_role',
        'role_user',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();
        $this->command->info('Database truncated.');

        $this->call('UserTableSeeder::class');
        $this->command->info('Users table seeded.');

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }

    /**
     * Truncate tables.
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach($this->tables as $tableName)
        {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
