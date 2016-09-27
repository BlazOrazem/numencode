<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Role can belong to many permissions.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

	/**
	 * Role can belong to many users.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany(User::class, 'role_user');
	}

	/**
	 * Role can belong to many managers.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function managers()
	{
		return $this->belongsToMany(Manager::class, 'role_manager');
	}

	/**
	 * Give permission to
	 *
	 * @param Permission $permission
	 * @return Model
	 */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}
