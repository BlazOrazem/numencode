<?php

namespace Numencode\Console\Commands\Dictionary;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Numencode\Models\System\Dictionary;

class LangExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:export {--group= : Whether only specific dictionary group should be exported}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export translations from database Dictionary to PHP language files.';

    /**
     * Laravel Filesystem
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new Lang command instance.
     *
     * @param Filesystem $files Illuminate Filesystem
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($group = $this->option('group')) {
            $translations = Dictionary::where('group', $group)->get();
        } else {
            $translations = Dictionary::all();
        }

        $this->line('');
        $bar = $this->output->createProgressBar(count($translations));

        foreach ($this->makeTree($translations) as $locale => $groups) {
            foreach ($groups as $group => $item) {
                $bar->advance();
                $path = $this->getLangPath() . DIRECTORY_SEPARATOR . $locale. DIRECTORY_SEPARATOR . $group. '.php';
                $output = "<?php\n\nreturn " . var_export($item, true) . ";\n";
                $this->files->put($path, $output);
            }
        }

        $bar->finish();
        $this->line('');

        $this->info(PHP_EOL . 'Export of the language files is completed.' . PHP_EOL);
    }

    /**
     * Create tree from translations
     *
     * @param $translations
     *
     * @return array
     */
    protected function makeTree($translations)
    {
        $tree = [];

        foreach ($translations as $translation) {
            array_set($tree[$translation->locale][$translation->group], $translation->key, $translation->value);
        }

        return $tree;
    }

    /**
     * Return full path to the language files.
     *
     * @return string
     */
    public function getLangPath()
    {
        return base_path() .
        DIRECTORY_SEPARATOR . 'modules' .
        DIRECTORY_SEPARATOR . 'Cms' .
        DIRECTORY_SEPARATOR . 'Resources' .
        DIRECTORY_SEPARATOR . 'lang';
    }
}
