<?php

namespace Numencode\Models\Page;

use Laraplus\Data\Translatable;
use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\Traits\HiddenFilter;

class Page extends Model
{
    use Attributes, Helpers, HiddenFilter, Relations, Sortable, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'layout', 'title', 'lead', 'body', 'sort_order', 'is_hidden'];

    /**
     * Eager load selected relations.
     *
     * @var array
     */
    protected $with = ['url'];
}
