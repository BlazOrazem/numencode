<?php

namespace Admin\Http;

use Admin\Models\Manager;

class ManagerController extends BaseController
{
    /**
     * Display the managers list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $managers = Manager::all();

        return view('admin::pages.managers', compact('managers'));
    }
}
