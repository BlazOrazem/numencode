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
//        if (!$this->confirm('Do you have Composer installed on your system? [y|N]', 'yes')) {
//            $this->error(PHP_EOL . 'Install Composer first and run this installer again.' . PHP_EOL);
//            exit();
//        }
//
//        $this->comment(PHP_EOL . 'Running composer install...' . PHP_EOL);
//        shell_exec('composer install');

//        require __DIR__.'/vendor/autoload.php';

//        $app = require_once __DIR__.'/bootstrap/app.php';
//        $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

//        $app = $this->getFreshApplication();
//
//        $dotenv = new Dotenv($app->environmentPath());
//        $dotenv->load($app->environmentPath(), $app->environmentFile());
//        dd(env('DB_DATABASE'));
//
//        $app = $this->getFreshApplication()['env'];
//        dd($app);
//
//        $app = $this->getFreshApplication()['db'];
//
//        $app->statement("UPDATE `managers` SET `name` = 'TEST' WHERE `id` = 10");
//        dd('done');
//        dd($app);

        $env = fopen(".env", "w");

        fwrite($env, 'APP_ENV=local' . PHP_EOL);
        fwrite($env, 'APP_KEY=SomeRandomString' . PHP_EOL);
        fwrite($env, 'APP_DEBUG=true' . PHP_EOL);
        fwrite($env, 'APP_LOG_LEVEL=debug' . PHP_EOL);

        $this->comment(PHP_EOL . 'Application settings');

        $appUrl = $this->ask('Enter the URL of your application (eg. http://www.numencode.app):');
        fwrite($env, 'APP_URL=' . $appUrl . PHP_EOL);
        fwrite($env, PHP_EOL);

        $this->comment(PHP_EOL . 'Database settings');

        $dbConn = $this->choice('Select your DB connection type:', ['mysql', 'sqlite', 'pgsql'], 0);
        fwrite($env, 'DB_CONNECTION=' . $dbConn . PHP_EOL);
        $dbHost = $this->anticipate('Enter the DB hostname:', ['localhost'], 'localhost');
        fwrite($env, 'DB_HOST=' . $dbHost . PHP_EOL);
        $dbPort = $this->anticipate('Enter the DB port:', ['3306'], '3306');
        fwrite($env, 'DB_PORT=' . $dbPort . PHP_EOL);
        $dbName = $this->ask('Enter the DB name:');
        fwrite($env, 'DB_DATABASE=' . $dbName . PHP_EOL);
        $dbUser = $this->ask('Enter the DB username:');
        fwrite($env, 'DB_USERNAME=' . $dbUser . PHP_EOL);
        $dbPass = $this->ask('Enter the DB password:');
        fwrite($env, 'DB_PASSWORD=' . $dbPass . PHP_EOL);

        fwrite($env, PHP_EOL);
        fwrite($env, 'GOOGLE_ANALYTICS=');

        fclose($env);

        $this->comment(PHP_EOL . 'Setting up application key...' . PHP_EOL);
        $this->call('key:generate');

        // MIGRATE & SEED

        $app = $this->getFreshApplication();

        $dotenv = new Dotenv($app->environmentPath());
        $dotenv->load($app->environmentPath(), $app->environmentFile());
        dd(env('DB_DATABASE'));

        $columnName = 'Tables_in_' . env('DB_DATABASE');

        $dropList = [];
        foreach (DB::select('SHOW TABLES') as $table) {
            $dropList[] = $table->$columnName;
        }

        if (!empty($dropList)) {
            $dropList = implode(',', $dropList);

            if (!$this->confirm('ARE YOU SURE you want to DROP ALL TABLES in the current database (' . env('DB_DATABASE') .')? [y|N]')) {
                exit('Drop tables command aborted.');
            }

            $this->info('Dropping all tables...');

            DB::beginTransaction();
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $dropList");
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();
        }

//        $app = require $this->laravel->bootstrapPath().'/app.php';
//        $app->make(ConsoleKernelContract::class)->bootstrap();

        $app = $this->getFreshApplication()['artisan'];
        $app::call('project:setup');

//        $exitCode = $app::call('project:setup');
//        $this->info($exitCode);

//        $this->call('project:setup');

//        $this->comment(PHP_EOL . 'You can now login to admin dashboard: ' . $appUrl . '/admin' . PHP_EOL);
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
