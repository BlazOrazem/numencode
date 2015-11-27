<?php

namespace Numencode\Providers;

use Illuminate\Routing\Router;
use Numencode\Http\Middleware\IsGuest;
use Numencode\Http\Middleware\IsAuthenticated;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * @var string
	 */
	protected $namespace = 'Numencode\Http\Controllers';

	/**
	 * This namespace is applied to the admin controller routes in your routes file.
	 *
	 * @var string
	 */
	protected $adminNamespace = '\Admin\Http\\';

	/**
	 * This namespace is applied to the cms controller routes in your routes file.
	 *
	 * @var string
	 */
	protected $cmsNamespace = '\Cms\Http\\';

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
		$router->group(['namespace' => $this->namespace], function ($router) {
			$this->publicRoutes($router);

			$this->authorizedRoutes($router);

			$this->guestRoutes($router);

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
		$router->get('auth/register/verify/{token}', 'Auth\AuthController@verifyEmail');
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
			$this->get('profile', 'ProfileController@index')->name('profile');
			$this->post('profile/update', 'ProfileController@updateProfile')->name('profile_update');
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
			$this->get('login', 'AuthController@getLogin')->name('login');
			$this->post('login', 'AuthController@postLogin')->name('login_action');

			// Registration
			$this->get('register', 'AuthController@getRegister')->name('register');
			$this->post('register', 'AuthController@postRegister')->name('register_action');

			// Social authentication
			$this->get('social/{provider?}', 'SocialAuthController@getLogin')->name('login_social');

			// Password reset
			$this->get('password/email', 'PasswordController@getEmail')->name('password_forget');
			$this->post('password/email', 'PasswordController@postEmail')->name('password_send');
			$this->get('password/reset/{token}', 'PasswordController@getPassword')->name('password_token');
			$this->post('password/reset', 'PasswordController@postPassword')->name('password_reset');
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
//			'namespace' => $this->adminNamespace,
			'prefix' => 'admin'
		], function () {
			// Admin dashboard
			$this->get('/', '\Admin\Http\DashboardController@index')->name('admin_home');
		});
	}
}
