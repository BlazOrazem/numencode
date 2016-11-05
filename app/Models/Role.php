<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label', 'sort_order'];

    /**
     * Role is deletable if no users or managers are assigned with it.
     *
     * @return bool
     */
    public function isDeletable()
    {
        return !($this->managers()->count() || $this->users()->count());
    }

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
