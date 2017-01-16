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
     * The attributes that have to be casted.
     *
     * @var array
     */
    protected $casts = ['completed' => 'boolean'];

    /**
     * Get all tasks
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTaskSelection()
    {
        return static::orderBy('title')->get()->pluck('title', 'id');
    }
}
