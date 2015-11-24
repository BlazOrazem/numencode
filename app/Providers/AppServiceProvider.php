<?php

namespace Numencode\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Admin namespace title.
	 *
	 * @var string
	 */
	protected $adminNamespace = 'admin';

	/**
	 * Cms namespace title.
	 *
	 * @var string
	 */
	protected $cmsNamespace = 'cms';

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
        //
    }
}
