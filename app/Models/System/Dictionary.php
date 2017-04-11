<?php

namespace Numencode\Models\System;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dictionary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group', 'code', 'title'];
}
