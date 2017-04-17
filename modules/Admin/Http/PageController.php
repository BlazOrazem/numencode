<?php

namespace Admin\Http;

use Numencode\Models\Menu;
use Numencode\Models\Page\Page;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
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
        $layouts = CodelistGroup::find(2)->items;
        $pages = Page::tree($page->menu);

        return view('admin::pages.edit', compact('page', 'layouts', 'pages'));
    }

    /**
     * Update the page.
     *
     * @param Page $page Page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Page $page)
    {
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
        // TODO delete page plugins

        return $this->deleteThe($page, 'pages.deleted');
    }
}
