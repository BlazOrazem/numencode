<?php

namespace Admin\Http;

class ManagerController extends BaseController
{
    /**
     * Display the managers list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::pages.managers');
    }
}
