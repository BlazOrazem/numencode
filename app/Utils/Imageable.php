<?php

namespace Numencode\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Imageable
{
    /**
     * Filename with extension.
     *
     * @var string
     */
    protected static $fileName;

    /**
     * Get filename with extension.
     *
     * @return string
     */
    public static function getFileName()
    {
        return static::$fileName;
    }

    /**
     * Set filename with extension.
     *
     * @param string $fileName Filename
     *
     * @return void
     */
    public static function setFileName($fileName)
    {
        static::$fileName = $fileName;
    }

    /**
     * Create image from uploaded file.
     *
     * @param UploadedFile $file   Uploaded file
     * @param null         $path   Upload path
     * @param null         $width  Image width
     * @param null         $height Image height
     * @param bool         $crop   Should image be cropped
     *
     * @return string
     */
    public static function createFromFile(UploadedFile $file, $path = null, $width = null, $height = null, $crop = false)
    {
        $image = Image::make($file);

        if (!static::getFileName()) {
            static::setFileName(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time()) . '.' . $file->getClientOriginalExtension());
        }

        return static::saveFile($image, $path, $width, $height, $crop);
    }

    /**
     * Create image from given image URL.
     *
     * @param string $url    Image URL
     * @param null   $path   Upload path
     * @param null   $width  Image width
     * @param null   $height Image height
     * @param bool   $crop   Should image be cropped
     *
     * @return string
     */
    public static function createFromUrl($url, $path = null, $width = null, $height = null, $crop = false)
    {
        $filename = basename(parse_url($url, PHP_URL_PATH));

        $image = Image::make(file_get_contents($url));

        if (!static::getFileName()) {
            static::setFileName(Str::slug(pathinfo($filename, PATHINFO_FILENAME) . '_' . time()) . '.' . pathinfo($filename, PATHINFO_EXTENSION));
        }

        return static::saveFile($image, $path, $width, $height, $crop);
    }

    /**
     * Create image from given base64 encoded string.
     *
     * @param string $data   Image data in base64 encoded string
     * @param string $name   Name of the image file
     * @param null   $path   Upload path
     * @param null   $width  Image width
     * @param null   $height Image height
     * @param bool   $crop   Should image be cropped
     *
     * @return string
     */
    public static function createFromData($data, $name, $path = null, $width = null, $height = null, $crop = false)
    {
        if (!$extension = static::getImageExtension($data)) {
            return null;
        }

        if ($filename = static::getFileName()) {
            $image = Image::make($data)->encode(pathinfo($filename, PATHINFO_EXTENSION), 100);
        } else {
            static::setFileName(Str::slug($name . '_' . time()) . '.' . $extension);
            $image = Image::make($data);
        }

        return static::saveFile($image, $path, $width, $height, $crop);
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
        $path = config("images.$plugin") ? config("images.$plugin.path") : '';

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time()) . '.' . $file->getClientOriginalExtension();

        static::setFileName($filename);

        static::createFromFile($file, $path, $width, $height, true);

        if (config("images.$plugin.crops")) {
            foreach (config("images.$plugin.crops") as $cropPath => $dimensions) {
                $directory = $path . '/' . $cropPath;

                if (!File::isDirectory($directory)) {
                    File::makeDirectory($directory, 0777, true, true);
                }

                static::createFromFile($file, $directory, $dimensions['width'], $dimensions['height'], true);
            }
        }

        return config('numencode.upload_path') . '/' . $path . '/' . $filename;
    }

    /**
     * Save image file.
     *
     * @param Image $image  Image file
     * @param null  $path   Upload path
     * @param null  $width  Image width
     * @param null  $height Image height
     * @param bool  $crop   Should image be cropped
     *
     * @return string
     */
    public static function saveFile($image, $path = null, $width = null, $height = null, $crop = false)
    {
        $path = config('numencode.upload_path') . ($path ? '/' . trim($path, ' /') . '/' : '/');
        $width = $width ?: config('images.default.width');
        $height = $height ?: config('images.default.height');

        if ($crop) {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })->encode('jpg', 100);
        } else {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 100);
        }

        $filePath = $path . static::getFileName();

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
                static::deleteFile(
                    config('numencode.upload_path') . '/' .
                    config("images.$plugin.path") . '/' .
                    $cropPath . '/' . basename($filename)
                );
            }
        }

        return static::deleteFile($filename);
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

    /**
     * Return image extension from base64 encoded string.
     *
     * @param string $data Image data in base64 encoded string
     *
     * @return bool|string
     */
    protected static function getImageExtension($data)
    {
        $encodedImageString = explode(',', $data, 2)[1];
        $decodedImageString = base64_decode($encodedImageString);
        $info = getimagesizefromstring($decodedImageString);
        $extension = substr($info['mime'], 6);

        if (!in_array($extension, ['png', 'gif', 'jpeg', 'jpg', 'bmp', 'webp'])) {
            return false;
        }

        return $extension;
    }
}
