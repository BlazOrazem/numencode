<?php

namespace Numencode\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
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
        View::composer('admin::*', 'Admin\Http\ViewComposers\PageComposer');

        View::composer('theme::*', 'Cms\Http\ViewComposers\PageComposer');

        Blade::directive('menu', function ($expression) {
            return '<?php echo (new \Numencode\Utils\MenuBuilder(' . $expression . ')); ?>';
        });
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
