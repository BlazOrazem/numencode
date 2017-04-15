<?php

namespace Numencode\Console\Commands\Dictionary;

use Illuminate\Console\Command;
use Numencode\Models\System\Dictionary;

class LangClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:clean {--locale= : Whether only specific locale translations should be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete translations from database dictionary.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($locale = $this->option('locale')) {
            Dictionary::where('locale', $locale)->delete();
        } else {
            $this->call('db:truncate', ['table_name' => 'dictionary', '--force' => true]);
        }

        $this->info('Translations are deleted from the database.' . PHP_EOL);
    }
}
