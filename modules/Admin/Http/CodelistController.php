<?php

namespace Admin\Http;

use Validator;
use Illuminate\Validation\Rule;
use Numencode\Models\CodelistItem;
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

        $validator = Validator::make(request()->all(), [
            'title' => ['required', Rule::unique('codelist_group')->ignore($id)],
            'sort_order'  => 'integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'groupErrors');
        }

        if ($codelistGroup->update(request()->all())) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.group_updated', ['name' => request()->title]));
        }

        return redirect()->route('codelist.index');
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

    /**
     * Store a newly created codelist item.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem($id)
    {
        $codelistGroup = CodelistGroup::findOrFail($id);

        $validator = Validator::make(request()->all(), [
            'code' => [
                'required',
                Rule::unique('codelist_item')->where(function ($query) use ($codelistGroup) {
                    $query->where('codelist_group_id', $codelistGroup->id);
                })
            ],
            'title' => 'required',
            'sort_order' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'itemErrors');
        }

        CodelistItem::forGroup($codelistGroup)->fill(request()->all())->save();

        flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.item_created', ['name' => request()->title]));

        return redirect()->back();
    }

    /**
     * Edit the codelist item.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function editItem($id)
    {
        $codelistItem = CodelistItem::findOrFail($id);

        $codelistGroup = CodelistGroup::with('items')->find($codelistItem->codelist_group_id);

        return view('admin::codelist.item', compact('codelistItem', 'codelistGroup'));
    }

    /**
     * Update the codelist item.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem($id)
    {
        $codelistItem = CodelistItem::findOrFail($id);

        $this->validate(request(), [
            'code' => [
                'required',
                Rule::unique('codelist_item')->where(function ($query) use ($codelistItem) {
                    $query->where('codelist_group_id', $codelistItem->codelist_group_id);
                })
            ],
            'title' => 'required',
            'sort_order'  => 'integer'
        ]);

        if ($codelistItem->update(request()->all())) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.item_updated', ['name' => request()->title]));
        }

        return redirect()->back();
    }

    /**
     * Delete the codelist item.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyItem($id)
    {
        $codelistItem = CodelistItem::findOrFail($id);

        if ($codelistItem->delete()) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.codelist.item_deleted'));
        }

        return redirect()->back();
    }
}
