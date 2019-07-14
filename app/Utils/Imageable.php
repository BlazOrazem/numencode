<?php

namespace Numencode\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
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
     * @param string $fileName Filename
     *
     * @return void
     */
    public static function setFileName($fileName)
    {
        self::$fileName = $fileName;
    }

    /**
     * Create image from uploaded file.
     *
     * @param UploadedFile $file       Uploaded file
     * @param null         $uploadPath Upload path
     * @param null         $width      Image width
     * @param null         $height     Image height
     * @param bool         $crop       Should image be cropped
     *
     * @return string
     */
    public static function createFromFile(UploadedFile $file, $uploadPath = null, $width = null, $height = null, $crop = true)
    {
        $image = Image::make($file);

        self::setFileName(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time()));

        return self::saveFile($image, $uploadPath, $width, $height, $crop);
    }

    /**
     * Create image from given image URL.
     *
     * @param string $url        Image URL.
     * @param null   $uploadPath Upload path
     * @param null   $width      Image width
     * @param null   $height     Image height
     * @param bool   $crop       Should image be cropped
     *
     * @return string
     */
    public static function createFromUrl($url, $uploadPath = null, $width = null, $height = null, $crop = true)
    {
        $image = Image::make(file_get_contents($url));

        self::setFileName(Str::slug($url . '_' . time()));

        return self::saveFile($image, $uploadPath, $width, $height, $crop);
    }

    /**
     * Create image from given encoded string.
     *
     * @param string $data       Image data in base64 encoded string.
     * @param null   $uploadPath Upload path
     *
     * @return string
     */
    public static function createFromData($data, $uploadPath)
    {
        $filePath = config('numencode.upload_path') . '/' . $uploadPath;

        $image = Image::make($data);
        $image->save($filePath);

        return $filePath;
    }

    /**
     * Create image from uploaded file for a specific plugin.
     *
     * @param UploadedFile $file   Uploaded file
     * @param string       $plugin The name of the plugin
     *
     * @return string
     */
    public static function createFromFileForPlugin(UploadedFile $file, $plugin)
    {
        $width = config("images.$plugin") ? config("images.$plugin.default.width") : config('images.default.width');
        $height = config("images.$plugin") ? config("images.$plugin.default.height") : config('images.default.height');
        $uploadPath = config('numencode.upload_path') . (config("images.$plugin") ? '/' . config("images.$plugin.path") : '');

        $filename = self::createFromFile($file, $uploadPath, $width, $height);

        if (config("images.$plugin.crops")) {
            self::setFileName($filename);

            foreach (config("images.$plugin.crops") as $cropPath => $dimensions) {
                $directory = $uploadPath . '/' . $cropPath;

                if (!File::isDirectory($directory)) {
                    File::makeDirectory($directory, 0777, true, true);
                }

                self::createFromFile($file, $directory, $dimensions['width'], $dimensions['height']);
            }
        }

        return $filename;
    }

    /**
     * Save image file.
     *
     * @param Image $image      Image file
     * @param null  $uploadPath Upload path
     * @param null  $width      Image width
     * @param null  $height     Image height
     * @param bool  $crop       Should image be cropped
     *
     * @return string
     */
    public static function saveFile($image, $uploadPath = null, $width = null, $height = null, $crop = true)
    {
        $uploadPath = $uploadPath ?: config('numencode.upload_path');

        if ($crop) {
            $width = $width ?: config('images.default.width');
            $height = $height ?: config('images.default.height');

            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })->encode('jpg', 100);
        } else {
            if (!$width && !$height) {
                $width = config('images.default.width');
            }

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 100);
        }

        $filePath = $uploadPath . '/' . self::getFileName() . '.jpg';

        $image->save($filePath);

        return $filePath;
    }

    /**
     * Delete all image files from a plugin.
     *
     * @param null   $filename Filename
     * @param string $plugin   The name of the plugin
     *
     * @return bool
     */
    public static function deleteFileForPlugin($filename, $plugin)
    {
        if (config("images.$plugin.crops")) {
            foreach (array_keys(config("images.$plugin.crops")) as $cropPath) {
                self::deleteFile(
                    config('numencode.upload_path') . '/' .
                    config("images.$plugin.path") . '/' .
                    $cropPath . '/' . basename($filename)
                );
            }
        }

        return self::deleteFile($filename);
    }

    /**
     * Delete image file from public path.
     *
     * @param null $filename Filename
     *
     * @return bool
     */
    public static function deleteFile($filename)
    {
        if (File::exists(public_path() . '/' . $filename)) {
            return unlink(public_path() . '/' . $filename);
        }

        return false;
    }
}
