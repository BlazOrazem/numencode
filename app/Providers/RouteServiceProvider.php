<?php

namespace Numencode\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Numencode\Http\Middleware\IsGuest;
use Numencode\Http\Middleware\IsAuthenticated;
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
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->authController = 'Auth\AuthController';

        if (config('login.throttle')) {
            $this->authController = 'Auth\AuthWithLoginThrottleController';
        }

        $router->group(['namespace' => $this->namespace], function ($router) {
            $this->publicRoutes($router);

            $this->authorizedRoutes($router);

            $this->guestRoutes($router);

            if (config('login.socialite')) {
                $this->socialiteRoutes($router);
            }

            $this->adminRoutes($router);
        });
    }

    /**
     * Public routes.
     *
     * @param Router $router
     */
    protected function publicRoutes(Router $router)
    {
        // Homepage
        $router->get('/', $this->cmsNamespace . 'HomeController@index');

        // User email verification
        $router->get('auth/register/verify/{token}', $this->cmsNamespace . $this->authController . '@verifyEmail');
    }

    /**
     * Authorized routes.
     *
     * @param Router $router
     */
    protected function authorizedRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'isAuthenticated',
            'namespace' => $this->cmsNamespace,
            'prefix' => 'auth'
        ], function () {
            // Authentication logout
            Route::get('logout', $this->authController . '@getLogout')->name('logout');

            // User profile
            Route::get('profile', 'Auth\ProfileController@index')->name('profile');
            Route::post('profile/update', 'Auth\ProfileController@updateProfile')->name('profile_update');
        });
    }

    /**
     * Guest routes.
     *
     * @param Router $router
     */
    protected function guestRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'isGuest',
            'namespace' => $this->cmsNamespace,
            'prefix' => 'auth'
        ], function () {
            // Authentication login
            Route::get('login', $this->authController . '@getLogin')->name('login');
            Route::post('login', $this->authController . '@postLogin')->name('login_action');

            // Registration
            Route::get('register', $this->authController . '@getRegister')->name('register');
            Route::post('register', $this->authController . '@postRegister')->name('register_action');

            // Password reset
            Route::get('password/email', 'Auth\PasswordController@getEmail')->name('password_forget');
            Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password_send');
            Route::get('password/reset/{token}', 'Auth\PasswordController@getPassword')->name('password_token');
            Route::post('password/reset', 'Auth\PasswordController@postPassword')->name('password_reset');
        });
    }

    /**
     * Socialite routes.
     *
     * @param Router $router
     */
    protected function socialiteRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'isGuest',
            'namespace' => $this->cmsNamespace,
            'prefix' => 'auth'
        ], function () {
            Route::get('social/{provider?}', 'Auth\SocialAuthController@getLogin')->name('login_social');
        });
    }

    /**
     * Admin routes.
     *
     * @param Router $router
     */
    protected function adminRoutes(Router $router)
    {
        $router->group([
//			'middleware' => IsAdmin::class,
            'namespace' => $this->adminNamespace,
            'prefix' => 'admin'
        ], function () {
            // Admin dashboard
            Route::get('/', 'DashboardController@index')->name('admin_home');
        });
    }
}
