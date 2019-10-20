<?php

namespace Numencode\Providers;

use Illuminate\Support\Facades\Gate;
use Numencode\Models\User\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'Numencode\Model' => 'Numencode\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
    }

    /**
     * Get all the permissions.
     *
     * @return array
     */
    protected function getPermissions()
    {
        if (app()->runningInConsole()) {
            return [];
        }

        return Permission::with('roles')->get();
    }
}
