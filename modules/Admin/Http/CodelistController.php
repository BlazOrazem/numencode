<?php

namespace Admin\Http;

use Numencode\Models\CodelistGroup;

class CodelistController extends BaseController
{
    /**
     * Display a listing of the roles and permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $codelistGroups = CodelistGroup::all()->sortBy('ord');
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
            'ord'  => 'integer'
        ]);

        CodelistGroup::create(request()->all());

        flash()->success(trans('admin::messages.success'), trans('admin::messages.tasks.created'));

        return redirect(route('codelist.index'));
    }
}
