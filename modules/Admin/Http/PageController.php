<?php

namespace Admin\Http;

use Illuminate\Support\Facades\Input;
use Numencode\Models\Menu;
use Numencode\Models\Page;
use Illuminate\Validation\Rule;
use Numencode\Models\CodelistGroup;

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
        $layouts = CodelistGroup::find(1)->items;
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
        $layouts = CodelistGroup::find(1)->items;

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
                trans('admin::menus.created', ['name' => request()->title])
            );
        }

        if (request()->subject == 'save') {
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
        $layouts = CodelistGroup::find(1)->items;
        $pages = Page::tree($page->menu);

        return view('admin::pages.edit', compact('page', 'layouts', 'pages'));
    }

    /**
     * Update the menu.
     *
     * @param Menu $menu Menu type
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Menu $menu)
    {
        $this->validate(request(), [
            'code'       => ['required', Rule::unique('menus')->ignore($menu->id)],
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($menu->update([
                'code'       => snake_slug(request()->code),
                'title'      => ucfirst(request()->title),
                'sort_order' => request()->sort_order,
            ])
        ) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::menus.updated', ['name' => request()->title])
            );
        }

        return redirect()->route('menus.index');
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
