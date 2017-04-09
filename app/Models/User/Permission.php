<?php

namespace Numencode\Models\User;

use Illuminate\Database\Eloquent\Model;
use Numencode\Models\System\Traits\Sortable;

class Permission extends Model
{
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label', 'is_admin', 'sort_order'];

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
