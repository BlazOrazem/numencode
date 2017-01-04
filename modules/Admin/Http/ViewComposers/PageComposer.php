<?php

namespace Admin\Http\ViewComposers;

use Illuminate\View\View;
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

        $view->with('menus', Menu::getAllWithTree());

        $view->with('activeUrl',
            url('/') . '/' .
            request()->segment(1) .
            (request()->segment(2) ? '/' . request()->segment(2) : '') .
            ((request()->segment(3) && !is_numeric(request()->segment(3))) ? '/' . request()->segment(3) : '')
        );
    }
}
