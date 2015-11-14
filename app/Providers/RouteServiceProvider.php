<?php

namespace App\Providers;

use Illuminate\Routing\Router;
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

            $router->group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {

                // Authentication routes
                $this->get('login',       'AuthController@getLogin')->name('login');
                $this->post('login',      'AuthController@postLogin')->name('login_action');
                $this->get('auth/logout', 'AuthController@getLogout')->name('logout');

                // Registration routes
                $this->get('register',                'AuthController@getRegister')->name('register');
                $this->post('register',               'AuthController@postRegister')->name('register_action');
                $this->get('register/verify/{token}', 'AuthController@verifyEmail');

                // Social authentication routes
                $this->get('social/{provider?}', 'SocialAuthController@getLogin')->name('login_social');

                // Password reset link request routes
                $this->get('password/email',  'PasswordController@getEmail')->name('password_forget');
                $this->post('password/email', 'PasswordController@postEmail')->name('password_send');

                // User profile routes
                $this->get('profile',           'ProfileController@index')->name('profile');
                $this->post('profile/update',   'ProfileController@updateProfile')->name('profile_update');
                $this->post('profile/password', 'ProfileController@updatePassword')->name('password_update');

            });

            // Password reset routes
            $router->get('password/reset/{token}', 'Auth\PasswordController@getReset');
            $router->post('password/reset',        'Auth\PasswordController@postReset')->name('password_reset');

            require app_path('Http/routes.php');
        });
    }
}
