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
}
