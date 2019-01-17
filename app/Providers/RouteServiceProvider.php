<?php

namespace Numencode\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the Admin controller routes in the routes file.
     *
     * @var string
     */
    protected $adminNamespace = 'Admin\Http\\';

    /**
     * This namespace is applied to the Cms controller routes in the routes file.
     *
     * @var string
     */
    protected $cmsNamespace = 'Cms\Http\\';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(function () {
                $this->mapDatabaseDrivenRoutes();
                $this->mapPublicRoutes();
                $this->mapPublicAuthorizedRoutes();
                $this->mapAuthRoutes();
                $this->mapAuthGuestRoutes();
                $this->mapAuthAuthorizedRoutes();
                if (config('login.socialite')) {
                    $this->mapAuthSocialiteRoutes();
                }
                $this->mapAdminGuestRoutes();
                $this->mapAdminAuthorizedRoutes();
            });
    }

    /**
     * Database-driven routes
     *
     * @return void
     */
    protected function mapDatabaseDrivenRoutes()
    {
        Route::middleware('localization')
            ->namespace($this->cmsNamespace)
            ->group(function ($router) {
                if (app()->runningInConsole()) {
                    return;
                }

                $uri = substr(app()->request->getRequestUri(), 1);

                $dbRoute = DB::table('routes')
                    ->leftJoin('routes_i18n', 'routes.id', '=', 'routes_i18n.route_id')
                    ->select('routes.*', 'routes_i18n.*')
                    ->where('uri', $uri)
                    ->first();

                if (!$dbRoute) {
                    return;
                }

                Route::get($uri, function () use ($dbRoute) {
                    $action = explode('@', $dbRoute->action);
                    $controller = app()->make($this->cmsNamespace . $action[0]);
                    $method = isset($action[1]) ? $action[1] : 'index';
                    $params = $dbRoute->params ? json_decode($dbRoute->params, true) : [];

                    return call_user_func_array([$controller, $method], $params);
                });
            });
    }

    /**
     * Public routes
     *
     * @return void
     */
    protected function mapPublicRoutes()
    {
        Route::middleware('localization')
            ->namespace($this->cmsNamespace)
            ->group(base_path('routes/public.php'));
    }

    /**
     * Public Authorized routes
     *
     * @return void
     */
    protected function mapPublicAuthorizedRoutes()
    {
        Route::middleware('is_authenticated')
            ->namespace($this->cmsNamespace)
            ->group(base_path('routes/public.authorized.php'));
    }

    /**
     * Authentication routes
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->namespace($this->cmsNamespace . 'Auth')
            ->group(base_path('routes/auth.php'));
    }

    /**
     * Authentication Guest routes
     *
     * @return void
     */
    protected function mapAuthGuestRoutes()
    {
        Route::middleware(['localization', 'is_guest'])
            ->namespace($this->cmsNamespace . 'Auth')
            ->group(base_path('routes/auth.guest.php'));
    }

    /**
     * Authentication Authorized routes
     *
     * @return void
     */
    protected function mapAuthAuthorizedRoutes()
    {
        Route::middleware('is_authenticated')
            ->namespace($this->cmsNamespace . 'Auth')
            ->group(base_path('routes/auth.authorized.php'));
    }

    /**
     * Authentication Socialite routes
     *
     * @return void
     */
    protected function mapAuthSocialiteRoutes()
    {
        Route::middleware('is_guest')
            ->namespace($this->cmsNamespace . 'Auth')
            ->group(base_path('routes/auth.socialite.php'));
    }

    /**
     * Admin Guest routes
     *
     * @return void
     */
    protected function mapAdminGuestRoutes()
    {
        Route::middleware('web')
            ->namespace($this->adminNamespace . 'Auth')
            ->prefix('admin')
            ->group(base_path('routes/admin.guest.php'));
    }

    /**
     * Admin Authorized routes
     *
     * @return void
     */
    protected function mapAdminAuthorizedRoutes()
    {
        Route::middleware(['translation', 'is_admin'])
            ->namespace($this->adminNamespace)
            ->prefix('admin')
            ->group(base_path('routes/admin.authorized.php'));
    }
}
