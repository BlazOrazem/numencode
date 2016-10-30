<?php

namespace Admin\Http;

use Numencode\Models\CodelistGroup;

class CodelistController extends BaseController
{
    /**
     * Display a listing of the codelist groups.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $codelistGroups = CodelistGroup::with('items')->get();
        $lastOrder = $codelistGroups->pluck('ord')->last() + 10;

        return view('admin::codelist.index', compact('codelistGroups', 'lastOrder'));
    }

    /**
     * Store a newly created codelist group.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|unique:codelist_group',
            'ord'  => 'required|integer'
        ]);

        CodelistGroup::create(request()->all());

        flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.group_created', ['name' => request()->title]));

        return redirect(route('codelist.index'));
    }

    /**
     * Show the codelist group edit form and codelist items for this group.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $codelistGroup = CodelistGroup::with('items')->find($id);
        dd($codelistGroup->toArray());

        return view('admin::codelist.edit', compact('codelistGroup'));
    }

    /**
     * Delete the codelist group.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $codelistGroup = CodelistGroup::findOrFail($id);

        if ($codelistGroup->delete()) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.group_deleted'));
        }

        return redirect()->back();
    }
}
