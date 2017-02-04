<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\Traits\HiddenFilter;

class Plugin extends Model
{
    use Sortable, HiddenFilter;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plugins';

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Cast attributes to other types.
     *
     * @var array
     */
    protected $casts = ['params' => 'object'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'action', 'params', 'sort_order', 'is_hidden'];
}
