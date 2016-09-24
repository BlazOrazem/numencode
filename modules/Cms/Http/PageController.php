<?php

namespace Cms\Http;

use Numencode\Models\Page;

class PageController extends BaseController
{
    /**
     * Display a page with it's plugins.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $page = Page::findOrFail($id);
        $plugins = plugins($this->getContents($page));

        return view('theme::pages.index', compact('page', 'plugins'));
    }

    /**
     * Get all contents for a page.
     *
     * @param Page $page
     * @return mixed
     */
    protected function getContents(Page $page)
    {
        return $page->contents()
            ->where('is_hidden', false)
            ->orderBy('ord')
            ->get(['*', 'params']);
    }
}
