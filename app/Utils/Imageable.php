<?php

namespace Numencode\Utils;

use File;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Imageable
{
    /**
     * Filename.
     *
     * @var string
     */
    protected static $fileName;

    /**
     * Get filename.
     *
     * @return string
     */
    public static function getFileName()
    {
        return self::$fileName;
    }

    /**
     * Set filename.
     *
     * @param string $fileName
     */
    public static function setFileName($fileName)
    {
        self::$fileName = $fileName;
    }

    /**
     * Create image from uploaded file.
     *
     * @param UploadedFile $file
     * @param null $uploadPath
     * @param null $width
     * @param null $height
     * @return string
     */
    public static function createFromFile(UploadedFile $file, $uploadPath = null, $width = null, $height = null, $crop = true)
    {
        $image = Image::make($file);

        self::setFileName(sha1(time() . $file->getClientOriginalName()));

        return self::saveFile($image, $uploadPath, $width, $height, $crop);
    }

    /**
     * Create image from given image URL.
     *
     * @param $url
     * @param null $uploadPath
     * @param null $width
     * @param null $height
     * @param bool $crop
     * @return string
     */
    public static function createFromUrl($url, $uploadPath = null, $width = null, $height = null, $crop = true)
    {
        $image = Image::make(file_get_contents($url));

        self::setFileName(sha1(time() . $url));

        return self::saveFile($image, $uploadPath, $width, $height, $crop);
    }

    /**
     * Save image file.
     *
     * @param Image $image
     * @param null $uploadPath
     * @param null $width
     * @param null $height
     * @param bool $crop
     * @return string
     */
    public static function saveFile($image, $uploadPath = null, $width = null, $height = null, $crop = true)
    {
        $uploadPath = $uploadPath ?: config('numencode.upload_path');

        if ($crop) {
            $width = $width ?: config('numencode.upload_width');
            $height = $height ?: config('numencode.upload_height');

            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })->encode('jpg', 100);
        } else {
            if (!$width && !$height) {
                $width = config('numencode.upload_width');
            }

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio(); // constrain aspect ratio
                $constraint->upsize();      // prevent possible up-sizing
            })->encode('jpg', 100);
        }

        $filePath = $uploadPath . '/' . self::getFileName() . '.jpg';

        $image->save($filePath);

        return $filePath;
    }

    /**
     * Delete image file.
     *
     * @param null $fileName
     */
    public static function deleteFile($fileName = null)
    {
        if ($fileName && File::exists(public_path() . '/' . $fileName)) {
            unlink(public_path() . '/' . $fileName);
        }
    }
}
