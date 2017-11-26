<?php

namespace Numencode\Providers;

use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Hashing\Hasher;
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
            $table = $app['config']['auth.passwords.users.table'];
            $key = $app['config']['app.key'];
            $expire = $app['config']->get('auth.passwords.users.expire', 60);

            return new DbRepository($connection, app(Hasher::class), $table, $key, $expire);
        });

        // Register Dusk service provider on local environment.
        if ($this->app->environment('local')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
