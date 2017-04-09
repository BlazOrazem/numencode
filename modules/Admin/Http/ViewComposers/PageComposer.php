<?php

namespace Admin\Http\ViewComposers;

use Illuminate\View\View;
use Numencode\Models\Page\Page;
use Numencode\Models\Menu;
use Illuminate\Support\Facades\Auth;

class PageComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view Instance of Illuminate\View\View
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('admin', Auth::guard('admin')->user());

        $view->with('menus', $this->getAllWithTree());

        $view->with('activeUrl',
            url('/') . '/' .
            request()->segment(1) .
            (request()->segment(2) ? '/' . request()->segment(2) : '') .
            ((request()->segment(3) && !is_numeric(request()->segment(3))) ? '/' . request()->segment(3) : '')
        );
    }

    /**
     * Return all menus with page tree structure.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getAllWithTree()
    {
        $menus = Menu::all();

        foreach ($menus as &$menu) {
            $menu->tree = $this->buildTreeMenu($menu->code);
        }

        return $menus;
    }

    /**
     * Create page tree structure.
     *
     * @param string $code Menu type code
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function buildTreeMenu($code)
    {
        $items = Page::with('url')->where('menu', $code)->get()->groupBy('parent_id');

        if ($items->count()) {
            $items['root'] = $items[''];
            unset($items['']);
        } else {
            $items = collect(['root' => collect()]);
        }

        return $items;
    }
}
