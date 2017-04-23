<?php

namespace Numencode\Models\System;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\System\Traits\Sortable;
use Numencode\Models\System\Traits\HiddenFilter;

class Language extends Model
{
    use HiddenFilter, Sortable;

    /**
     * Cache validity in minutes.
     *
     * @var int
     */
    protected static $minutes = 60;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * Return default language.
     *
     * @return string
     */
    public static function getDefault()
    {
        return Cache::remember('lang_default', static::$minutes, function () {
            return static::whereNotNull('is_default')->first();
        });
    }

    /**
     * Return all languages.
     *
     * @return array
     */
    public static function getAll()
    {
        return Cache::remember('lang_all', static::$minutes, function () {
            return static::get();
        });
    }

    /**
     * Return all languages locales.
     *
     * @return array
     */
    public static function getAllLocales()
    {
        return Cache::remember('lang_all_locales', static::$minutes, function () {
            return static::get()->pluck('label', 'locale');
        });
    }
}
