<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	/**
	 * Permission can belongs to many roles.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
