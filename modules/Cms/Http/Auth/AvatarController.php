<?php

namespace Cms\Http\Auth;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AvatarController
{
    /**
     * Avatar filename.
     *
     * @var string
     */
    protected static $avatarFileName;

    /**
     * Get avatar filename.
     *
     * @return string
     */
    public static function getAvatarFileName()
    {
        return self::$avatarFileName;
    }

    /**
     * Set avatar filename.
     *
     * @param string $avatarFileName Avatar file name.
     *
     * @return null
     */
    public static function setAvatarFileName($avatarFileName)
    {
        self::$avatarFileName = $avatarFileName;
    }

    /**
     * Create avatar image from uploaded file.
     *
     * @param UploadedFile $file Uploaded file.
     *
     * @return string
     */
    public static function makeAvatarFromFile(UploadedFile $file)
    {
        $image = Image::make($file);

        self::setAvatarFileName(sha1(time() . $file->getClientOriginalName()));

        return self::saveAvatarFile($image);
    }

    /**
     * Create avatar image from given image URL.
     *
     * @param string $avatarUrl Url of the avatar image.
     *
     * @return string
     */
    public static function makeAvatarFromUrl($avatarUrl)
    {
        $avatarUrl = fix_avatar_url($avatarUrl);

        $image = Image::make(file_get_contents($avatarUrl));

        self::setAvatarFileName(sha1(time() . $avatarUrl));

        return self::saveAvatarFile($image);
    }

    /**
     * Save avatar image file.
     *
     * @param Image $image Image file.
     *
     * @return string
     */
    public static function saveAvatarFile($image)
    {
        $image->resize(config('login.avatar_width'), config('login.avatar_height'), function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('jpg', 100);

        $filePath = config('login.avatar_path') . '/' . self::getAvatarFileName() . '.jpg';

        $image->save($filePath);

        return $filePath;
    }

    /**
     * Delete avatar image file.
     *
     * @param string|null $fileName Filename to be deleted.
     *
     * @return null
     */
    public static function deleteAvatarFile($fileName = null)
    {
        if ($fileName && File::exists(public_path() . '/' . $fileName)) {
            unlink(public_path() . '/' . $fileName);
        }
    }

    /**
     * TODO Image Caching
     * http://stackoverflow.com/questions/29098814/laravel-5-intervention-image-intervention-cache-flexible-url-routing
     *
     * @param $avatarFileName
     * @param $width
     * @param $height
     * @return \Intervention\Image\Image
     */
    public static function getAvatarImageUrl($avatarFileName, $width, $height)
    {
        $img = Image::cache(function($image) use ($avatarFileName, $width, $height) {
            return $image->make($avatarFileName)->resize($width, $height);
        });

        return $img;
    }
}
