<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class CodelistItem extends Model
{
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'codelist_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'title', 'ord'];

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;
}
