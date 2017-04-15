<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\System\Dictionary;
use Numencode\Models\Codelist\CodelistItem;

class DictionaryController extends BaseController
{
    /**
     * Display a listing of the dictionary.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $groups = CodelistItem::where('codelist_group_id', config('numencode.dictionary_codelist_group_id'))
            ->orderBy('title')
            ->pluck('title', 'code');

        $dictionary = Dictionary::get()->groupBy('locale');

        $tree = [];
        foreach ($dictionary as $locale => $translations) {
            foreach ($translations->groupBy('group') as $key => $translation) {
                foreach ($translation as $item) {
                    array_set($tree[$locale][$groups[$key]], $item->id, $item);
                }
            }
        }

//        dd($tree);

        return view('admin::dictionary.index', compact('tree'));
    }

    /**
     * Store a newly created dictionary item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        //
    }

    /**
     * Show the dictionary edit form.
     *
     * @param Dictionary $dictionary Dictionary item
     *
     * @return \Illuminate\View\View
     */
    public function edit(Dictionary $dictionary)
    {
        //
    }

    /**
     * Update the dictionary item.
     *
     * @param Dictionary $dictionary Dictionary item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Dictionary $dictionary)
    {
        //
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
        return $this->deleteThe($dictionary, 'dictionary.deleted');
    }
}
