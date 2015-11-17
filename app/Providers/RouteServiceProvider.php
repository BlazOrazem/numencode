<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use App\Http\Middleware\IsGuest;
use App\Http\Middleware\IsAuthenticated;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {

            $this->authorizedRoutes($router);
            $this->guestRoutes($router);
            $this->publicRoutes($router);

            require app_path('Http/routes.php');
        });
    }

    /**
     * Public routes.
     *
     * @param Router $router
     */
    protected function publicRoutes(Router $router)
    {
        $router->group([
            'namespace' => 'Auth',
            'prefix' => 'auth'
        ], function () {
            // User email verification
            $this->get('register/verify/{token}', 'AuthController@verifyEmail');
        });
    }

    /**
     * Authorized routes.
     *
     * @param Router $router
     */
    protected function authorizedRoutes(Router $router)
    {
        $router->group([
            'middleware' => IsAuthenticated::class,
            'namespace' => 'Auth',
            'prefix' => 'auth'
        ], function () {
            // Authentication logout
            $this->get('logout', 'AuthController@getLogout')->name('logout');

            // User profile
            $this->get('profile',           'ProfileController@index')->name('profile');
            $this->post('profile/update',   'ProfileController@updateProfile')->name('profile_update');
            $this->post('profile/password', 'ProfileController@updatePassword')->name('password_update');
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
            'middleware' => IsGuest::class,
            'namespace' => 'Auth',
            'prefix' => 'auth'
        ], function () {
            // Authentication login
            $this->get('login',  'AuthController@getLogin')->name('login');
            $this->post('login', 'AuthController@postLogin')->name('login_action');

            // Registration
            $this->get('register',  'AuthController@getRegister')->name('register');
            $this->post('register', 'AuthController@postRegister')->name('register_action');

            // Social authentication
            $this->get('social/{provider?}', 'SocialAuthController@getLogin')->name('login_social');

            // Password reset
            $this->get('password/email',         'PasswordController@getEmail')->name('password_forget');
            $this->post('password/email',        'PasswordController@postEmail')->name('password_send');
            $this->get('password/reset/{token}', 'PasswordController@getPassword')->name('password_token');
            $this->post('password/reset',        'PasswordController@postPassword')->name('password_reset');
        });
    }
}
