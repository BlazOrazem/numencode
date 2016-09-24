<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'ord', 'is_hidden'];

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];


    public function contents()
    {
        return $this->belongsToMany(Content::class, 'page_content');
    }
}
