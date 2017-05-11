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
        return view('admin::codelist.index', ['codelistGroups' => CodelistGroup::all()]);
    }

    /**
     * Store a newly created codelist group.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'code'       => 'required|unique:codelist_group',
            'title'      => 'required',
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
     * @param CodelistGroup $codelistGroup Codelist group
     *
     * @return \Illuminate\View\View
     */
    public function edit(CodelistGroup $codelistGroup)
    {
        return view('admin::codelist.edit', compact('codelistGroup'));
    }

    /**
     * Update the codelist group.
     *
     * @param CodelistGroup $codelistGroup Codelist group
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CodelistGroup $codelistGroup)
    {
        $this->validateWithBag('groupErrors', request(), [
            'code'       => ['required', Rule::unique('codelist_group')->ignore($codelistGroup->id)],
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($codelistGroup->update(request()->all())) {
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
     * @param CodelistGroup $codelistGroup Codelist group
     *
     * @return array
     * @throws \Exception
     */
    public function destroy(CodelistGroup $codelistGroup)
    {
        return $this->deleteThe($codelistGroup, 'codelist.group_deleted');
    }

    /**
     * Store a newly created codelist item.
     *
     * @param CodelistGroup $codelistGroup Codelist group
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem(CodelistGroup $codelistGroup)
    {
        $this->validateWithBag('itemErrors', request(), [
            'code' => [
                'required',
                Rule::unique('codelist_item')->where(function ($query) use ($codelistGroup) {
                    $query->where('codelist_group_id', $codelistGroup->id);
                }),
            ],
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (CodelistItem::forGroup($codelistGroup)->fill(request()->all())->save()) {
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
     * @param CodelistItem $codelistItem Codelist item
     *
     * @return \Illuminate\View\View
     */
    public function editItem(CodelistItem $codelistItem)
    {
        return view('admin::codelist.item', compact('codelistItem'));
    }

    /**
     * Update the codelist item.
     *
     * @param CodelistItem $codelistItem Codelist item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem(CodelistItem $codelistItem)
    {
        $this->validate(request(), [
            'code' => [
                'required',
                Rule::unique('codelist_item')->where(function ($query) use ($codelistItem) {
                    $query->where('codelist_group_id', $codelistItem->codelist_group_id);
                })->ignore($codelistItem->id),
            ],
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($codelistItem->update(request()->all())) {
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
     * @param CodelistItem $codelistItem Codelist item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyItem(CodelistItem $codelistItem)
    {
        return $this->deleteThe($codelistItem, 'codelist.item_deleted');
    }
}
