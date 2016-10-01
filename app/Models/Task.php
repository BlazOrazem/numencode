<?php

namespace Numencode\Models;

use Laraplus\Data\Translatable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Translatable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'completed'];

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
