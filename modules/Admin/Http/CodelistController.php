<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\Codelist\CodelistItem;
use Numencode\Models\Codelist\CodelistGroup;

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

        return view('admin::codelist.index', compact('codelistGroups'));
    }

    /**
     * Store a newly created codelist group.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'title'      => 'required|unique:codelist_group',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (CodelistGroup::create(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::codelist.group_created', ['name' => request()->title])
            );
        }

        return redirect()->route('codelist.index');
    }

    /**
     * Show the codelist group edit form and codelist items for this group.
     *
     * @param CodelistGroup $codelist Codelist group
     *
     * @return \Illuminate\View\View
     */
    public function edit(CodelistGroup $codelist)
    {
        return view('admin::codelist.edit', ['codelistGroup' => $codelist->with('items')->first()]);
    }

    /**
     * Update the codelist group.
     *
     * @param CodelistGroup $codelist Codelist group
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CodelistGroup $codelist)
    {
        $this->validateWithBag('groupErrors', request(), [
            'title'      => ['required', Rule::unique('codelist_group')->ignore($codelist->id)],
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($codelist->update(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::codelist.group_updated', ['name' => request()->title])
            );
        }

        return redirect()->back();
    }

    /**
     * Delete the codelist group.
     *
     * @param CodelistGroup $codelist Codelist group
     *
     * @return array
     * @throws \Exception
     */
    public function destroy(CodelistGroup $codelist)
    {
        return $this->deleteThe($codelist, 'codelist.group_deleted');
    }

    /**
     * Store a newly created codelist item.
     *
     * @param CodelistGroup $codelist Codelist group
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem(CodelistGroup $codelist)
    {
        $this->validateWithBag('itemErrors', request(), [
            'code' => [
                'required',
                Rule::unique('codelist_item')->where(function ($query) use ($codelist) {
                    $query->where('codelist_group_id', $codelist->id);
                }),
            ],
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (CodelistItem::forGroup($codelist)->fill(request()->all())->save()) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::codelist.item_created', ['name' => request()->title])
            );
        }

        return redirect()->back();
    }

    /**
     * Edit the codelist item.
     *
     * @param CodelistItem $item Codelist item
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editItem(CodelistItem $item)
    {
        $codelistGroup = CodelistGroup::with('items')->find($item->codelist_group_id);

        return view('admin::codelist.item', ['codelistItem' => $item, 'codelistGroup' => $codelistGroup]);
    }

    /**
     * Update the codelist item.
     *
     * @param CodelistItem $item Codelist item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem(CodelistItem $item)
    {
        $this->validate(request(), [
            'code' => [
                'required',
                Rule::unique('codelist_item')->where(function ($query) use ($item) {
                    $query->where('codelist_group_id', $item->codelist_group_id);
                }),
            ],
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($item->update(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::codelist.item_updated', ['name' => request()->title])
            );
        }

        return redirect()->back();
    }

    /**
     * Delete the codelist item.
     *
     * @param CodelistItem $item Codelist item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyItem(CodelistItem $item)
    {
        return $this->deleteThe($item, 'codelist.item_deleted');
    }
}
