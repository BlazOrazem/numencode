<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\System\Dictionary;

class DictionaryController extends BaseController
{
    /**
     * Display a listing of the dictionary.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dictionary = Dictionary::all();

        return view('admin::dictionary.index', compact('dictionary'));
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
