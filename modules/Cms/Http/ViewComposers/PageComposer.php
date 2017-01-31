<?php

namespace Cms\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use Numencode\Models\Menu;
use Numencode\Models\Page;

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
        $view->with('signedIn', Auth::guard()->check());

        $view->with('user', Auth::guard()->user());

        foreach (Menu::all() as $menu) {
            $view->with($menu->code . 'Menu', $this->buildMenu($menu));
        }
    }

    /**
     * Build navigation tree structure.
     *
     * @param Menu $menu Menu
     *
     * @return mixed
     */
    public function buildMenu(Menu $menu)
    {
        $items = Page::with('url')->where('menu', $menu->code)->orderBy('sort_order')->get()->groupBy('parent_id');

        if (count($items)) {
            $items['root'] = $items[''];
            unset($items['']);
        }

        return $items;
    }
}
