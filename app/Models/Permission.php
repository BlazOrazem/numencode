<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label', 'sort_order'];

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
