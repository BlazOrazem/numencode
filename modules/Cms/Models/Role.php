<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}
