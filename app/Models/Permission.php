<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Sortable;

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
