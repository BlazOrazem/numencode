<?php

namespace Numencode\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application composers.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin::layout', 'admin::pages.index'], 'Admin\Http\ViewComposers\PageComposer');

        View::composer('theme::layouts.*', 'Cms\Http\ViewComposers\PageComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
