<?php

namespace Admin\Http;

use Validator;
use Illuminate\Validation\Rule;
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
        $lastOrder = $codelistGroups->pluck('sort_order')->last() + 10;

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
            'sort_order'  => 'integer'
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

        return view('admin::codelist.edit', compact('codelistGroup'));
    }

    /**
     * Update the codelist group.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $codelistGroup = CodelistGroup::findOrFail($id);


        // TODO: Multiple forms validation:
        // https://laracasts.com/discuss/channels/laravel/authcontroller-loginregistration-on-same-page

        $validator = new Validator;
        $validator::make(request()->all(), [
            'title' => ['required', Rule::unique('codelist_group')->ignore($id)],
            'sort_order'  => 'integer'
        ])->validate();

//        $this->validate(request(), [
//            'title' => ['required', Rule::unique('codelist_group')->ignore($id)],
//            'sort_order'  => 'integer'
//        ]);

        if ($codelistGroup->update(request()->all())) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.group_updated', ['name' => request()->title]));
        }

        if ($validator->fails()) {
            return redirect()->route('codelist.index')->withErrors($validator, 'updateGroup');

//            return redirect('post/create')
//                ->withErrors($validator)
//                ->withInput();
        } else {

            return redirect()->route('codelist.index');
        }

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
