<?php

namespace Cms\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
        'avatar_thumbnail',
        'social_provider_type',
        'social_provider_id',
        'is_verified',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'is_verified', 'token'];

    /**
     * Bootstrap application services for user.
     */
    public static function boot()
    {
        parent::boot();

        /**
         * Set token for email address verification if user is not registered via social provider.
         */
        static::creating(function ($user) {
            if ($user->is_verified) {
                return;
            }

            $user->token = str_random(30);
        });
    }

    /**
     * Verify user's email address.
     */
    public function verifyEmail()
    {
        $this->is_verified = true;
        $this->token = null;

        $this->save();
    }
}
