<?php

namespace Numencode\Models\User;

use Illuminate\Notifications\Notifiable;
use Numencode\Models\User\Traits\UserRoles;
use Numencode\Models\User\Traits\UserHelpers;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UserHelpers, UserRoles, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'avatar',
        'social_provider_type',
        'social_provider_id',
        'is_verified',
    ];

    /**
     * The attributes excluded from the models' JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'is_verified', 'token'];

    /**
     * Bootstrap application services for user.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Set token for email address verification
        // if user is not registered via social provider.
        static::creating(function ($user) {
            if ($user->is_verified) {
                return;
            }
            $user->token = str_random(30);
        });
    }
}
