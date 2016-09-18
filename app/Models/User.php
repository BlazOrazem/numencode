<?php

namespace Numencode\Models;

use Cms\Traits\UserRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UserRoles, Notifiable;

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
    protected $hidden = [
        'password', 'remember_token', 'is_verified', 'token',
    ];

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at',
    ];

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
