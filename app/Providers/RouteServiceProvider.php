<?php

namespace Numencode\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the admin controller routes in your routes file.
     *
     * @var string
     */
    protected $adminNamespace = 'Admin\Http\\';

    /**
     * This namespace is applied to the cms controller routes in your routes file.
     *
     * @var string
     */
    protected $cmsNamespace = 'Cms\Http\\';

    /**
     * Authentication controller name.
     *
     * @var
     */
    protected $authController;

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
        $this->authController = 'Auth\AuthController';

        if (config('login.throttle')) {
            $this->authController = 'Auth\AuthWithLoginThrottleController';
        }

        Route::group([
            'namespace' => $this->namespace,
            'middleware' => 'web',
        ], function () {
            $this->publicRoutes();

            $this->mapGuestRoutes();

            $this->authorizedRoutes();


            if (config('login.socialite')) {
                $this->socialiteRoutes();
            }

            $this->adminRoutes();
        });
    }

    /**
     * Public routes.
     */
    protected function publicRoutes()
    {
        // Homepage
        Route::get('/', $this->cmsNamespace . 'HomeController@index');

        // User email verification
//        Route::get('auth/register/verify/{token}', $this->cmsNamespace . $this->authController . '@verifyEmail');
    }

    /**
     * Guest routes
     */
    protected function mapGuestRoutes()
    {
        Route::group([
            'middleware' => 'isGuest',
            'namespace' => $this->cmsNamespace . 'Auth',
        ], function ($router) {
            require base_path('routes/auth.guest.php');
        });
    }

    /**
     * Authorized routes
     */
    protected function authorizedRoutes()
    {
        Route::group([
            'middleware' => 'isAuthenticated',
            'namespace' => $this->cmsNamespace . 'Auth',
        ], function ($router) {
            require base_path('routes/auth.authorized.php');
        });
    }

    /**
     * Socialite routes.
     */
    protected function socialiteRoutes()
    {
        Route::group([
            'middleware' => 'isGuest',
            'namespace' => $this->cmsNamespace,
        ], function () {
            Route::get('social/{provider?}', 'Auth\SocialAuthController@getLogin')->name('login_social');
        });
    }

    /**
     * Admin routes.
     */
    protected function adminRoutes()
    {
        Route::group([
            'namespace' => $this->adminNamespace,
            'prefix' => 'admin',
        ], function () {
            // Admin authentication login
            Route::get('login', 'Auth\AuthController@getLogin')->name('admin.login');
            Route::post('login', 'Auth\AuthController@postLogin')->name('admin.login.action');
        });

        Route::group([
			'middleware' => 'isAdmin',
            'namespace' => $this->adminNamespace,
            'prefix' => 'admin',
        ], function () {
            // Admin dashboard
            Route::get('/', 'DashboardController@index')->name('admin.dashboard');

            // Authentication logout
            Route::get('logout', 'Auth\AuthController@getLogout')->name('admin.logout');

            // Managers
            Route::resource('manager', 'ManagerController');

            // Users
//            Route::resource('user', 'UserController');

            // Tasks
            Route::get('task/api', 'TaskController@api')->name('admin.tasks.api');
            Route::resource('task', 'TaskController');
        });
    }
}
