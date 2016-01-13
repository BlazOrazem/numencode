<?php

namespace Numencode\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Auth\Passwords\DatabaseTokenRepository as DbRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Admin namespace.
     *
     * @var string
     */
    protected $adminNamespace = 'admin';

    /**
     * Cms namespace.
     *
     * @var string
     */
    protected $cmsNamespace = 'theme';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load views for modules
        $this->loadViewsFrom($this->app->basePath() . '/modules/Admin/Resources/views', $this->adminNamespace);
        $this->loadViewsFrom($this->app->basePath() . '/modules/Cms/Resources/views', $this->cmsNamespace);

        // Load languages for modules
        $this->loadTranslationsFrom($this->app->basePath() . '/modules/Admin/Resources/lang', $this->adminNamespace);
        $this->loadTranslationsFrom($this->app->basePath() . '/modules/Cms/Resources/lang', $this->cmsNamespace);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TokenRepositoryInterface::class, function ($app) {
            $connection = $app['db']->connection();
            $table = $app['config']['auth.password.table'];
            $key = $app['config']['app.key'];
            $expire = $app['config']->get('auth.password.expire', 60);
            return new DbRepository($connection, $table, $key, $expire);
        });
    }
}
