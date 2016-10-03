<?php

namespace Cms\Http;

use Numencode\Models\Page;

class PageController extends BaseController
{
    /**
     * Display a page.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $page = Page::findOrFail($id);

        return view('theme::pages.index', compact('page'));
    }
}
