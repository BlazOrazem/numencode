<?php

namespace Numencode\Models\User;

use Cms\Http\Auth\AvatarController;
use Numencode\Models\Traits\UserRoles;
use Illuminate\Notifications\Notifiable;
use Cms\Http\Auth\ForgotPasswordController;
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

    /**
     * Verify users' email address.
     *
     * @return void
     */
    public function verifyEmail()
    {
        $this->is_verified = true;
        $this->token = null;

        $this->save();
    }

    /**
     * Get avatar
     *
     * @param int  $width  Avatar width
     * @param null $height Avatar height
     *
     * @return \Intervention\Image\Image|null
     */
    public function avatar($width = 100, $height = null)
    {
        $height = $height ?: $width;

        if (!$this->avatar) {
            return;
        }

        return AvatarController::getAvatarImageUrl($this->avatar, $width, $height);
    }
}
