<?php

namespace Numencode\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Numencode\Models\User\Traits\ManagerRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use ManagerRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone', 'avatar', 'tasks'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Cast attributes to other types.
     *
     * @var array
     */
    protected $casts = ['tasks' => 'object'];
}
