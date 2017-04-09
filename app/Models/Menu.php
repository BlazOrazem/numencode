<?php

namespace Numencode\Models;

use Numencode\Models\Page\Page;
use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Sortable;

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'title', 'sort_order'];

    /**
     * Menu has many pages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Page::class, 'menu', 'code');
    }
}
