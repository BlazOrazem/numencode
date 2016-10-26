<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class CodelistItem extends Model
{
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
