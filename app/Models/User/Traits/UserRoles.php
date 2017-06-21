<?php

namespace Numencode\Models\User\Traits;

use Illuminate\Database\Eloquent\Collection;
use Numencode\Models\User\Role;

trait UserRoles
{
    /**
     * User can have many roles.
     *
     * @return object
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Assign roles to the user.
     *
     * @param array $roleIds Role IDs
     *
     * @return null
     */
    public function assignRoles(array $roleIds)
    {
        foreach ($roleIds as $roleId) {
            $role = Role::find($roleId);

            if ($this->hasRole($role->name)) {
                continue;
            }

            $this->roles()->save($role);
        }

        return true;
    }

    /**
     * Determine if the entity has a given role.
     *
     * @param string|object|collection $role Role name
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        if ($role instanceof Collection) {
            return !!$this->roles->intersect($role)->count();
        }

        return $this->roles->contains($role);
    }
}
