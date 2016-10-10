<?php

namespace Numencode\Providers;

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
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @internal void
     */
    public function map()
    {
        Route::group([
            'namespace' => $this->namespace,
            'middleware' => 'web',
        ], function () {
            $this->mapPublicRoutes();
            $this->mapAuthRoutes();
            $this->mapAuthGuestRoutes();
            $this->mapAuthAuthorizedRoutes();
            if (config('login.socialite')) {
                $this->mapAuthSocialiteRoutes();
            }
            $this->mapAdminGuestRoutes();
            $this->mapAdminAuthorizedRoutes();
            $this->mapDatabaseDrivenRoutes();
        });
    }

    /**
     * Public routes
     */
    protected function mapPublicRoutes()
    {
        Route::group([
            'namespace' => $this->cmsNamespace,
        ], function ($router) {
            require base_path('routes/public.php');
        });
    }

    /**
     * Authentication routes
     */
    protected function mapAuthRoutes()
    {
        Route::group([
            'namespace' => $this->cmsNamespace . 'Auth',
        ], function ($router) {
            require base_path('routes/auth.php');
        });
    }

    /**
     * Authentication Guest routes
     */
    protected function mapAuthGuestRoutes()
    {
        Route::group([
            'middleware' => 'isGuest',
            'namespace' => $this->cmsNamespace . 'Auth',
        ], function ($router) {
            require base_path('routes/auth.guest.php');
        });
    }

    /**
     * Authentication Authorized routes
     */
    protected function mapAuthAuthorizedRoutes()
    {
        Route::group([
            'middleware' => 'isAuthenticated',
            'namespace' => $this->cmsNamespace . 'Auth',
        ], function ($router) {
            require base_path('routes/auth.authorized.php');
        });
    }

    /**
     * Authentication Socialite routes
     */
    protected function mapAuthSocialiteRoutes()
    {
        Route::group([
            'middleware' => 'isGuest',
            'namespace' => $this->cmsNamespace . 'Auth',
        ], function ($router) {
            require base_path('routes/auth.socialite.php');
        });
    }

    /**
     * Admin Guest routes
     */
    protected function mapAdminGuestRoutes()
    {
        Route::group([
            'namespace' => $this->adminNamespace,
            'prefix' => 'admin',
        ], function ($router) {
            require base_path('routes/admin.guest.php');
        });
    }

    /**
     * Admin Authorized routes
     */
    protected function mapAdminAuthorizedRoutes()
    {
        Route::group([
            'middleware' => 'isAdmin',
            'namespace' => $this->adminNamespace,
            'prefix' => 'admin',
        ], function ($router) {
            require base_path('routes/admin.authorized.php');
        });
    }

    /**
     * Database-driven routes
     */
    protected function mapDatabaseDrivenRoutes()
    {
        Route::group([
            'namespace' => $this->cmsNamespace,
        ], function ($router) {
            if (app()->runningInConsole()) {
                return;
            }

            $uri = substr(app()->request->getRequestUri(), 1);

//            $dbRoute = Route::where('uri', '=', $uri)->first();
//
//            if ($dbRoute) {
//                $router->get($uri, function () use ($dbRoute) {
//                    $segments = explode('@', $dbRoute->action);
//                    $controller = $segments[0];
//                    $method = $segments[1];
//                    $obj = app()->make($this->namespace . '\\' . $controller);
//                    $params = (!empty($dbRoute->params)) ? unserialize($dbRoute->params) : [];
//
//                    return call_user_func_array([$obj, $method], $params);
//                });
//            }

        });
    }
}
