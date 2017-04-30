<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\System\Language;

class LanguageController extends BaseController
{
    /**
     * Display a listing of the languages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::all();

        return view('admin::languages.index', compact('languages'));
    }

    /**
     * Store a newly created language.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'locale'     => 'required|unique:languages',
            'label'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (isset(request()->is_default)) {
            Language::where('is_default', true)->update(['is_default' => null]);
        }

        if (Language::create(array_merge(request()->all(), [
            'is_default' => isset(request()->is_default) ?: null,
            'is_hidden'  => isset(request()->is_hidden) ?: null,
        ]))) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::languages.created', ['name' => request()->label])
            );
        }

        return redirect()->route('languages.index');
    }

    /**
     * Update the language.
     *
     * @param Language $language Language
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Language $language)
    {
        $this->validate(request(), [
            'locale'     => ['required', Rule::unique('languages')->ignore($language->id)],
            'label'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (isset(request()->is_default)) {
            Language::where('is_default', true)->update(['is_default' => null]);
        }

        if ($language->update(array_merge(request()->all(), [
            'is_default' => isset(request()->is_default) ?: null,
            'is_hidden'  => isset(request()->is_hidden) ?: null,
        ]))) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::languages.updated', ['name' => request()->label])
            );
        }

        return redirect()->route('languages.index');
    }

    /**
     * Delete the language.
     *
     * @param Language $language Language
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Language $language)
    {
        $isDefault = $language->is_default;

        $language->delete();

        if ($isDefault) {
            Language::first()->update(['is_default' => true]);
        }

        return redirect()->route('languages.index');
    }
}
