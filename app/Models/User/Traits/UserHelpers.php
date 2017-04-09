<?php

namespace Numencode\Models\User\Traits;

use Cms\Http\Auth\AvatarController;

trait UserHelpers
{
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
