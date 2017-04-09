<?php

namespace Numencode\Models;

use Laraplus\Data\Translatable;
use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\Traits\HiddenFilter;
use Numencode\Models\Attributes\PageAttributes;

class Page extends Model
{
    use HiddenFilter, PageAttributes, Sortable, Translatable;

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

    /**
     * Page belongs to url.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function url()
    {
        return $this->belongsTo(Url::class, 'route_id');
    }

    /**
     * Page has many contents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Page can have many sub pages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * Merge general and page contents, sort the collection by order and return.
     *
     * @return mixed
     */
    public function getContents()
    {
        $generalContents = Content::whereNull('page_id')->get();

        return $generalContents->merge($this->contents()->get())->sortBy('sort_order');
    }

    /**
     * Build tree structure for pages.
     *
     * @param string $menu Menu type
     *
     * @return \Illuminate\Support\Collection
     */
    protected function tree($menu)
    {
        $items = static::where('menu', $menu)->get()->groupBy('parent_id');

        if ($items->count()) {
            $items['root'] = $items[''];
            unset($items['']);
        } else {
            $items = collect(['root' => collect()]);
        }

        return $items;
    }
}
