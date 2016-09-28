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
        View::composer(
            'admin::layout', 'Admin\Http\ViewComposers\PageComposer'
        );
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
