<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['controller', 'method', 'params', 'ord', 'is_hidden'];


    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_content');
    }
}
