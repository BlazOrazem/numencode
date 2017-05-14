<?php

namespace Admin\Http;

use Numencode\Models\System\Language;
use Numencode\Models\System\Dictionary;
use Numencode\Models\Codelist\CodelistGroup;

class DictionaryController extends BaseController
{
    /**
     * Display a listing of the dictionary.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $groups = CodelistGroup::itemsFor(config('numencode.dictionary_codelist_group'));
        $groupArray = $groups->pluck('title', 'code');

        $dictionary = Dictionary::orderBy('group')->orderBy('key')->get()->groupBy('locale');

        $tree = [];
        foreach ($dictionary as $locale => $translations) {
            foreach ($translations->groupBy('group') as $key => $translation) {
                foreach ($translation as $item) {
                    array_set($tree[$locale][$groupArray[$key]], $item->id, $item);
                }
            }
        }

        return view('admin::dictionary.index', compact('tree', 'groups'));
    }

    /**
     * Store a newly created dictionary item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'group' => 'required',
            'key'   => 'required',
        ]);

        if (request()->ajax()) {
            return success();
        }

        foreach (Language::getAllLocales()->keys() as $locale) {
            $value = 'value_' . $locale;
            Dictionary::create([
                'locale' => $locale,
                'group'  => request()->group,
                'key'    => snake_slug(request()->key),
                'value'  => request()->$value,
            ]);
        }

        event('dictionary.update', request()->group);

        flash()->success(
            trans('admin::messages.success'),
            trans('admin::dictionary.created', ['name' => snake_slug(request()->key)])
        );

        return redirect()->route('dictionary.index');
    }

    /**
     * Update the dictionary item.
     *
     * @return array
     */
    public function update()
    {
        $dictionary = Dictionary::find(request()->pk);
        $dictionary->value = request()->value;
        $dictionary->save();

        event('dictionary.update', $dictionary->group);

        return success();
    }

    /**
     * Delete the dictionary item.
     *
     * @param Dictionary $dictionary Dictionary item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dictionary $dictionary)
    {
        Dictionary::where('group', $dictionary->group)->where('key', $dictionary->key)->delete();

        event('dictionary.update', $dictionary->group);

        return redirect()->route('dictionary.index');
    }
}
