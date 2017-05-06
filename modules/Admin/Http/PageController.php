<?php

namespace Admin\Http;

use Numencode\Models\Page\Page;
use Numencode\Models\System\Url;
use Numencode\Models\Content\Menu;
use Numencode\Models\Content\Content;
use Admin\Repositories\RouteRepository;
use Numencode\Models\Codelist\CodelistGroup;

class PageController extends BaseController
{
    /**
     * Display the page structure.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::pages.index');
    }

    /**
     * Show the form for creating a new page for a selected menu type.
     *
     * @param Menu $menu Menu
     *
     * @return \Illuminate\View\View
     */
    public function createForMenu(Menu $menu)
    {
        $layouts = CodelistGroup::find(2)->items;
        $pages = Page::tree($menu->code);

        return view('admin::pages.create', compact('pages', 'menu', 'layouts'));
    }

    /**
     * Show the form for creating a new page for a selected parent page.
     *
     * @param Page $page Page
     *
     * @return \Illuminate\View\View
     */
    public function createForPage(Page $page)
    {
        $layouts = CodelistGroup::find(2)->items;

        return view('admin::pages.create', compact('page', 'layouts'));
    }

    /**
     * Store a newly created page.
     *
     * @param RouteRepository $route Route repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RouteRepository $route)
    {
        $this->validate(request(), [
            'layout'     => 'required',
            'menu'       => 'required',
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($page = Page::create([
            'parent_id'  => request()->has('parent_id') ? request()->parent_id : null,
            'menu'       => request()->menu,
            'layout'     => request()->layout,
            'title'      => request()->title,
            'lead'       => request()->lead,
            'body'       => request()->body,
            'sort_order' => request()->sort_order,
        ])
        ) {
            $page->route_id = $route->saveUrl(null, request()->title, 'PageController@index', ['id' => $page->id]);
            $page->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::pages.created', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('pages.edit', compact('page'));
        }

        return redirect()->route('pages.index');
    }

    /**
     * Show the page edit form.
     *
     * @param Page $page Page
     *
     * @return \Illuminate\View\View
     */
    public function edit(Page $page)
    {
        $page = Page::find($page->id);
        $layouts = CodelistGroup::find(2)->items;
        $pages = Page::tree($page->menu);

        return view('admin::pages.edit', compact('page', 'layouts', 'pages'));
    }

    /**
     * Update the page.
     *
     * @param Page            $page  Page
     * @param RouteRepository $route Route repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Page $page, RouteRepository $route)
    {
        $page = Page::find($page->id);

        $this->validate(request(), [
            'layout'     => 'required',
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($page->update([
            'parent_id'  => request()->parent_id,
            'layout'     => request()->layout,
            'title'      => request()->title,
            'lead'       => request()->lead,
            'body'       => request()->body,
            'sort_order' => request()->sort_order,
        ])
        ) {
            $page->route_id = $route->saveUrl(request()->link, request()->title, 'PageController@index', ['id' => $page->id]);
            $page->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::pages.updated', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('pages.edit', compact('page'));
        }

        return redirect()->route('pages.index');
    }

    /**
     * Activate the page.
     *
     * @param Page $page Page
     *
     * @return void
     */
    public function active(Page $page)
    {
        $page->is_hidden = $page->is_hidden ? null : true;
        $page->save();
    }

    /**
     * Delete the page.
     *
     * @param Page $page Page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Page $page)
    {
        Url::where('id', $page->route_id)->delete();
        Content::where('page_id', $page->id)->delete();

        $result = $this->deleteThe($page, 'pages.deleted');

        $this->cleanUnusedItems();

        return $result;
    }

    /**
     * Delete unused pages with related routes and contents.
     *
     * @return bool
     */
    protected function cleanUnusedItems()
    {
        $pages = Page::whereNotIn('parent_id', Page::get()->pluck('id'))->get();

        if (!$pages->count()) {
            return true;
        }

        foreach ($pages as $page) {
            Url::where('id', $page->route_id)->delete();
            Content::where('page_id', $page->id)->delete();
            $page->delete();
        }

        $this->cleanUnusedItems();
    }

}
