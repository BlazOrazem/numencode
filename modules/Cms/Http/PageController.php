<?php

namespace Cms\Http;

use Numencode\Models\Page;

class PageController extends BaseController
{
    /**
     * Display a page.
     *
     * @param $id
     * @param null $locale
     * @return \Illuminate\View\View
     */
    public function index($id, $locale = null)
    {
        $page = $locale ? Page::translateInto($locale)->first($id) : Page::first($id);

        return view('theme::pages.index', compact('page'));
    }
}
