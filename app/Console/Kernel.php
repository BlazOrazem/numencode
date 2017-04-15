<?php

namespace Numencode\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Numencode\Console\Commands\Admin\Bower::class,
        \Numencode\Console\Commands\Admin\Gulp::class,
        \Numencode\Console\Commands\Admin\Npm::class,
        \Numencode\Console\Commands\Admin\Yarn::class,
        \Numencode\Console\Commands\Dictionary\LangImport::class,
        \Numencode\Console\Commands\Database\MigrateFresh::class,
        \Numencode\Console\Commands\Database\TruncateTable::class,
        \Numencode\Console\Commands\ProjectInstall::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule Schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
