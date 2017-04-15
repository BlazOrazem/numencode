<?php

namespace Numencode\Console\Commands\Dictionary;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Numencode\Models\System\Dictionary;
use Numencode\Models\Codelist\CodelistItem;
use Numencode\Models\Codelist\CodelistGroup;

class LangImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import translations from PHP language files to database Dictionary.';

    /**
     * Laravel Filesystem
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Codelist Group for dictionary
     *
     * @var CodelistGroup
     */
    protected $codelistGroup;

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
     * Get Codelist Group
     *
     * @return CodelistGroup
     */
    public function getCodelistGroup()
    {
        return $this->codelistGroup;
    }

    /**
     * Set Codelist Group
     *
     * @param CodelistGroup $codelistGroup Codelist Group
     */
    public function setCodelistGroup(CodelistGroup $codelistGroup)
    {
        $this->codelistGroup = $codelistGroup;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setCodelistGroup(CodelistGroup::find(config('numencode.dictionary_codelist_group_id')));

        foreach ($this->files->directories($this->getLangPath()) as $langPath){
            $locale = basename($langPath);

            foreach ($this->files->allfiles($langPath) as $file) {
                $info = pathinfo($file);
                $filename = $info['dirname'] . DIRECTORY_SEPARATOR . $info['basename'];
                $group = $info['filename'];

                // Dictionary group
                if (!CodelistItem::where('codelist_group_id', $this->getCodelistGroup()->id)->where('code', $group)->exists()) {
                    CodelistItem::forceCreate([
                        'codelist_group_id' => $this->getCodelistGroup()->id,
                        'code' => $group,
                        'title' => ucfirst($group),
                        'sort_order' => CodelistItem::where('codelist_group_id', $this->getCodelistGroup()->id)->get()->max('sort_order') + 10,
                    ]);
                }

                foreach ($this->parseLangFile($filename) as $key => $value) {
                    if (!Dictionary::where('locale', $locale)->where('group', $group)->where('key', $key)->exists()) {
                        Dictionary::forceCreate([
                            'locale' => $locale,
                            'group' => $group,
                            'key' => $key,
                            'value' => $value,
                        ]);
                    } else {
                        Dictionary::where('locale', $locale)->where('group', $group)->where('key', $key)->update([
                            'value' => $value,
                        ]);
                    }
                }
            }

        }

        $this->info('Import of the language files is completed.' . PHP_EOL);
    }

    /**
     * Parse given language php file and return array.
     *
     * @param string $filename Lang filename
     *
     * @return array
     */
    protected function parseLangFile($filename)
    {
        return eval(str_replace('<?php', '', $this->files->get($filename)));
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
