<?php

namespace Numencode\Console\Commands;

use Dotenv\Dotenv;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;

class ProjectInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the NumencodeCMS project.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Welcome user

        $this->comment(PHP_EOL . '-------------------------------------');
        $this->comment('| Welcome to NumencodeCMS installer |');
        $this->comment('-------------------------------------' . PHP_EOL);

        $this->line('This wizard will guide you through the setup process.' . PHP_EOL);
        $this->info('If any errors appear during the setup process, repair');
        $this->info('them according to error messages and run installer again.' . PHP_EOL);

        $this->line('Make sure you have an empty database prepared before continuing.' . PHP_EOL);

        if (!$this->confirm('Everything is ready to go, shall we continue? [Y|n]')) {
            $this->comment('Sorry to see you go :(' . PHP_EOL);
        }

        // Create .env file

        $env = fopen(".env", "w");

        fwrite($env, 'APP_ENV=production' . PHP_EOL);
        fwrite($env, 'APP_KEY=' . PHP_EOL);
        fwrite($env, 'APP_DEBUG=false' . PHP_EOL);

        $this->comment(PHP_EOL . '------------------------');
        $this->comment('| Application settings |');
        $this->comment('------------------------');

        $appName = $this->ask('Enter your application name (eg. My Company)');
        $appMail = $this->ask('Enter your application email (eg. info@test.com)');

        $appUrl = $this->ask('Enter the URL of your application without trailing slash (eg. https://www.numencode.com)');
        fwrite($env, 'APP_URL=' . $appUrl . PHP_EOL);
        fwrite($env, PHP_EOL);

        $this->comment(PHP_EOL . '---------------------');
        $this->comment('| Database settings |');
        $this->comment('---------------------');

        $dbConn = $this->choice('Select your DB connection type - press Enter for', ['mysql', 'sqlite', 'pgsql'], 0);
        fwrite($env, 'DB_CONNECTION=' . $dbConn . PHP_EOL);
        $dbHost = $this->anticipate('Enter the DB hostname - press Enter for', ['localhost'], 'localhost');
        fwrite($env, 'DB_HOST=' . $dbHost . PHP_EOL);
        $dbPort = $this->anticipate('Enter the DB port - press Enter for default MySQL port', ['3306'], '3306');
        fwrite($env, 'DB_PORT=' . $dbPort . PHP_EOL);
        $dbName = $this->ask('Enter the DB name');
        fwrite($env, 'DB_DATABASE=' . $dbName . PHP_EOL);
        $dbUser = $this->ask('Enter the DB username');
        fwrite($env, 'DB_USERNAME=' . $dbUser . PHP_EOL);
        $dbPass = $this->ask('Enter the DB password');
        fwrite($env, 'DB_PASSWORD=' . $dbPass . PHP_EOL);

        fwrite($env, PHP_EOL);
        fwrite($env, 'MAIL_DRIVER=log' . PHP_EOL);
        fwrite($env, 'MAIL_HOST=' . PHP_EOL);
        fwrite($env, 'MAIL_PORT=' . PHP_EOL);
        fwrite($env, 'MAIL_USERNAME=' . PHP_EOL);
        fwrite($env, 'MAIL_PASSWORD=' . PHP_EOL);
        fwrite($env, 'MAIL_ENCRYPTION=null' . PHP_EOL);
        fwrite($env, 'MAIL_FROM_ADDRESS=' . $appMail . PHP_EOL);
        fwrite($env, 'MAIL_FROM_NAME="' . $appName . '"' . PHP_EOL);

        fwrite($env, PHP_EOL);
        fwrite($env, 'GOOGLE_ANALYTICS=');

        fclose($env);

        // Setup the application key

        $this->comment(PHP_EOL . '-------------------');
        $this->comment('| Application key |');
        $this->comment('-------------------');

        $this->comment(PHP_EOL . 'Setting up application key...' . PHP_EOL);
        $this->call('key:generate');
        $this->call('config:cache');

        // Boot up a new application

        $app = $this->getFreshApplication();
        $db = $app['db'];
        $artisan = $app['artisan'];

        // Load newly generated .env variables

        $dotEnv = new Dotenv($app->environmentPath());
        $dotEnv->load($app->environmentPath(), $app->environmentFile());

        // Run migrations and seed database

        $this->comment(PHP_EOL . PHP_EOL . '-----------------------------------');
        $this->comment('| Database migrations and seeding |');
        $this->comment('-----------------------------------');

        $columnName = 'Tables_in_' . env('DB_DATABASE');

        $dropList = [];
        foreach ($db->select("SHOW TABLES") as $table) {
            $dropList[] = $table->$columnName;
        }

        if (!empty($dropList)) {
            $dropList = implode(',', $dropList);

            $this->line(PHP_EOL . 'Your selected database (' . env('DB_DATABASE') .') is not empty!');

            if (!$this->confirm('ARE YOU SURE you want to DROP ALL TABLES in the current database (' . env('DB_DATABASE') .')? [y|N]')) {
                $this->comment('You can run installer again anytime!' . PHP_EOL);
                $this->error('Drop tables command aborted.' . PHP_EOL);
                exit();
            }

            $this->info('Dropping all tables...');

            $db->beginTransaction();
            $db->statement('SET FOREIGN_KEY_CHECKS = 0');
            $db->statement("DROP TABLE $dropList");
            $db->statement('SET FOREIGN_KEY_CHECKS = 1');
            $db->commit();
        }

        $this->comment(PHP_EOL . 'Running database migrations...' . PHP_EOL);
        $artisan::call('migrate');
        $this->info('Database tables were successfully migrated.' . PHP_EOL);

        $this->comment('Running database seeders...' . PHP_EOL);
        $artisan::call('db:seed');
        $this->info('Database seeding was successfully completed.' . PHP_EOL);

        // Import translations to database

        $this->comment(PHP_EOL . '--------------------');
        $this->comment('| Dictionary setup |');
        $this->comment('--------------------');

        $this->comment('Importing translations to database...' . PHP_EOL);
        $artisan::call('lang:import');
        $this->info('Dictionary was successfully imported.' . PHP_EOL);

        // Setup the admin manager account

        $this->comment(PHP_EOL . '-------------------------');
        $this->comment('| Admin manager account |');
        $this->comment('-------------------------');

        $email = $this->ask('Enter the email address for the admin account');
        $password = bcrypt($this->secret('Enter the password for the admin account'));

        $db->statement("UPDATE `managers` SET `email` = '{$email}', `password` = '{$password}' WHERE `id` = 1");

        $this->info('Admin manager was successfully created.' . PHP_EOL);

        // Complete the installation

        $this->comment(PHP_EOL . '-------------------');
        $this->comment('| Admin dashboard |');
        $this->comment('-------------------' . PHP_EOL);

        $this->line('You can now login to admin dashboard with your username and password.');
        $this->comment(PHP_EOL . 'Admin dashboard URL: ' . $appUrl . '/admin' . PHP_EOL);

        $this->comment(PHP_EOL . 'Project is successfully installed.');

        $this->comment(PHP_EOL . '------------------------------------');
        $this->comment('| Thank you for using NumencodeCMS |');
        $this->comment('------------------------------------' . PHP_EOL);

        // Silently setup the application key again to prevent any errors

        sleep(3);
        $appKey = $this->getFreshApplication();
        $artisanKey = $appKey['artisan'];
        $artisanKey::call('key:generate');
        $artisanKey::call('config:cache');
    }

    /**
     * Get a fresh application instance.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function getFreshApplication()
    {
        return tap(require $this->laravel->bootstrapPath().'/app.php', function ($app) {
            $app->make(ConsoleKernelContract::class)->bootstrap();
        });
    }
}
