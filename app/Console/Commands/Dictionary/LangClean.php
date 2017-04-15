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
    protected $signature = 'lang:clean {--lang= : Whether only specific language should be cleaned}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all translations from database dictionary.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($selectedLang = $this->option('lang')) {
            Dictionary::where('locale', $selectedLang)->delete();
        } else {
            $this->call('db:truncate', ['table_name' => 'dictionary', '--force' => true]);
        }


        $this->info('Translations are deleted from the database.');
    }
}
