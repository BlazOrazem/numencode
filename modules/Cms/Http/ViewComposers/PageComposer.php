<?php

namespace Cms\Http\ViewComposers;

use Illuminate\View\View;
use Numencode\Models\Menu;
use Numencode\Models\Page;

class PageComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        foreach (Menu::all() as $menu) {
            $view->with($menu->code . 'Menu', $this->buildMenu($menu));
        }
    }

    /**
     * Build navigation tree structure.
     *
     * @param Menu $menu
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
