<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class CodelistGroup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'codelist_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'ord'];
}
