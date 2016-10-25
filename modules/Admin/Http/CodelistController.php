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

        return view('admin::codelist.index', compact('codelistGroups'));
    }
}
