<?php

namespace Numencode\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fresh {--noseed : Whether the database seeding should not be executed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables from database and rebuild it using migrations and seeders.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Run migrations and seed database

        $this->comment(PHP_EOL . '-----------------------------------');
        $this->comment('| Database migrations and seeding |');
        $this->comment('-----------------------------------');

        $columnName = 'Tables_in_' . env('DB_DATABASE');

        $dropList = [];
        foreach (DB::select("SHOW TABLES") as $table) {
            $dropList[] = $table->$columnName;
        }

        if (!empty($dropList)) {
            $dropList = implode(',', $dropList);

            $this->line(PHP_EOL . 'Your selected database (' . env('DB_DATABASE') .') is not empty!');

            if (!$this->confirm('ARE YOU SURE you want to DROP ALL TABLES in the current database (' . env('DB_DATABASE') .')? [y|N]')) {
                $this->comment('You can run migrate fresh again anytime!' . PHP_EOL);
                $this->error('Drop tables command aborted.' . PHP_EOL);
                exit();
            }

            $this->info('Dropping all tables...');

            DB::beginTransaction();
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $dropList");
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();
        }

        $this->comment(PHP_EOL . 'Running database migrations...' . PHP_EOL);
        $this->call('migrate');
        $this->info('Database tables were successfully migrated.' . PHP_EOL);

        if (!$this->option('noseed')) {
            $this->comment('Running database seeders...' . PHP_EOL);
            $this->call('db:seed');
            $this->info('Database seeding was successfully completed.' . PHP_EOL);
        }

        // Import translations to database

        $this->comment(PHP_EOL . '--------------------');
        $this->comment('| Dictionary setup |');
        $this->comment('--------------------');

        $this->comment('Importing translations to database...' . PHP_EOL);
        $this->call('lang:import');
        $this->info('Dictionary was successfully imported.' . PHP_EOL);

        // Setup the admin manager account

        $this->comment(PHP_EOL . '-------------------------');
        $this->comment('| Admin manager account |');
        $this->comment('-------------------------');

        $email = $this->ask('Enter the email address for the admin account');
        $password = bcrypt($this->secret('Enter the password for the admin account'));

        DB::statement("UPDATE `managers` SET `email` = '{$email}', `password` = '{$password}' WHERE `id` = 1");

        $this->info('Admin manager was successfully created.' . PHP_EOL);

        // Complete the installation

        $this->comment(PHP_EOL . '-------------------');
        $this->comment('| Admin dashboard |');
        $this->comment('-------------------' . PHP_EOL);

        $this->line('You can now login to admin dashboard with your username and password.');
        $this->comment(PHP_EOL . 'Admin dashboard URL: ' . env('APP_URL') . '/admin' . PHP_EOL);

        $this->comment(PHP_EOL . '------------------------------------');
        $this->comment('| Thank you for using NumencodeCMS |');
        $this->comment('------------------------------------' . PHP_EOL);
    }
}
