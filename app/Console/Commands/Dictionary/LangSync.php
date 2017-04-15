<?php

namespace Numencode\Console\Commands\Dictionary;

use Illuminate\Console\Command;
use Numencode\Models\System\Dictionary;

class LangSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:sync {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize translation keys from one locale to another.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $translations = Dictionary::where('locale', $this->argument('from'))->get();

        $this->line('');
        $bar = $this->output->createProgressBar(count($translations));

        foreach ($translations as $translation) {
            $bar->advance();
            if (!Dictionary::where('locale', $this->argument('to'))
                    ->where('group', $translation->group)
                    ->where('key', $translation->key)->exists()) {
                Dictionary::forceCreate([
                    'locale' => $this->argument('to'),
                    'group' => $translation->group,
                    'key' => $translation->key,
                    'value' => $translation->value,
                ]);
            }
        }

        $bar->finish();
        $this->line('');

        $this->info(PHP_EOL . 'Translations for "'. $this->argument('to') .'" with non-existent keys have been created from "' . $this->argument('from') . '".' . PHP_EOL);
    }
}
