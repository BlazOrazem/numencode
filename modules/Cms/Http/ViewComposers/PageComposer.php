<?php

namespace Cms\Http\ViewComposers;

use Auth;
use Illuminate\View\View;

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
    }
}
