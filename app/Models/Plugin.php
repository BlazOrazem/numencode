<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plugins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'controller', 'method', 'ord', 'is_hidden'];
}
