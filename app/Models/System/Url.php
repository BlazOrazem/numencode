<?php

namespace Numencode\Models\System;

use Laraplus\Data\Translatable;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'routes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['action', 'uri', 'params'];

    /**
     * Cast attributes to other types.
     *
     * @var array
     */
    protected $casts = ['params' => 'object'];

    /**
     * Disable timestamps for this table.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Foreign key for translatable table.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'route_id';
    }

    public function saveUnique($url = null, $title)
    {
        $url = $url ?: str_slug($title);

        $this->uri = $this->handleLocalizationAndDuplication($url);
        $this->save();
    }

    // TODO handle url duplication
    protected function handleLocalizationAndDuplication($url)
    {
        if (app()->getLocale() != Language::getDefault()->locale) {
            $url = app()->getLocale() . '/' . ltrim($url, app()->getLocale() . '/');
        }

        if ($this->where('uri', $url)->exists()) {
//            dd($url);
        }

        return $url;

//        dd(app()->getLocale());
    }
}
