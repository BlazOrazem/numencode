<?php

namespace Numencode\Console\Commands;

use DB;
use Illuminate\Console\Command;

class MigrateFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fresh {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables from database and rebuild it using migrations.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('CONFIRM DROP ALL TABLES IN THE CURRENT DATABASE? [y|N]')) {
            exit('Drop tables command aborted.');
        }

        $this->info('Dropping all tables...');

        $columnName = 'Tables_in_' . env('DB_DATABASE');

        $dropList = [];
        foreach (DB::select('SHOW TABLES') as $table) {
            $dropList[] = $table->$columnName;
        }

        if (!empty($dropList)) {
            $dropList = implode(',', $dropList);
            DB::beginTransaction();
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $dropList");
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();
        }

        $this->comment(PHP_EOL . 'Running migrations...' . PHP_EOL);
        $this->call('migrate');

        if ($this->option('seed')) {
            $this->comment(PHP_EOL . 'Running seeders...' . PHP_EOL);
            $this->call('db:seed');
        }

        $this->comment(PHP_EOL . 'Migrations are refreshed.' . PHP_EOL);
    }
}
