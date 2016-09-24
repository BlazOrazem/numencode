<?php

namespace Numencode\Console\Commands;

use DB;
use Illuminate\Console\Command;

class DropTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:droptables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all of the tables in the current database.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('CONFIRM DROP ALL TABLES IN THE CURRENT DATABASE? [y|N]')) {
            exit('Drop Tables command aborted.');
        }

        $columnName = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $dropList[] = $table->$columnName;
        }

        $dropList = implode(',', $dropList);

        DB::beginTransaction();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement("DROP TABLE $dropList");
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::commit();

        $this->comment(PHP_EOL."If no errors showed up, all tables were dropped".PHP_EOL);
    }
}
