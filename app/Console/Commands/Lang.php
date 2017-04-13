<?php

namespace Numencode\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Numencode\Models\System\Dictionary;
use Numencode\Models\Codelist\CodelistItem;
use Numencode\Models\Codelist\CodelistGroup;

class Lang extends Command
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
    protected $description = 'Import translations from php language files to database dictionary.';

    protected $files;
    protected $codelistGroupID;

    /**
     * Create a new Lang command instance.
     *
     * @param Filesystem $files Illuminate Filesystem
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;

        $this->codelistGroup = CodelistGroup::findOrFail(config('numencode.dictionary_codelist_group_id'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->files->directories($this->getLangPath()) as $langPath){
            $locale = basename($langPath);

            foreach ($this->files->allfiles($langPath) as $file) {
                $info = pathinfo($file);
                $filename = $info['dirname'] . DIRECTORY_SEPARATOR . $info['basename'];
                $group = $info['filename'];

                // Dictionary group
                if (!CodelistItem::where('codelist_group_id', $this->codelistGroup->id)->where('code', $group)->exists()) {
                    CodelistItem::forceCreate([
                        'codelist_group_id' => $this->codelistGroup->id,
                        'code' => $group,
                        'title' => ucfirst($group),
                        'sort_order' => CodelistItem::where('codelist_group_id', $this->codelistGroup->id)->get()->max('sort_order') + 10,
                    ]);
                }

                foreach ($this->parseLangFile($filename) as $code => $title) {
                    if (!Dictionary::where('locale', $locale)->where('group', $group)->where('code', $code)->exists()) {
                        Dictionary::forceCreate([
                            'locale' => $locale,
                            'group' => $group,
                            'code' => $code,
                            'title' => $title,
                        ]);
                    } else {
                        Dictionary::where('locale', $locale)->where('group', $group)->where('code', $code)->update([
                            'title' => $title,
                        ]);
                    }
                }
            }

        }

        $this->info('Import of the language files is completed.');
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
