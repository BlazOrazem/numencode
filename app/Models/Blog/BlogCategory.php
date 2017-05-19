<?php

namespace Numencode\Models\Blog;

use Laraplus\Data\Translatable;
use Numencode\Models\System\Url;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\System\Traits\Sortable;

class BlogCategory extends Model
{
    use Sortable, Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'lead', 'body', 'sort_order'];

    /**
     * Eager load selected relations.
     *
     * @var array
     */
    protected $with = ['url'];

    /**
     * No fallback translation.
     *
     * @var bool
     */
    protected $withFallback = false;

    /**
     * Use only translated items.
     *
     * @var bool
     */
    protected $onlyTranslated = true;

    /**
     * Blog category has many items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(BlogItem::class);
    }

    /**
     * Blog category belongs to url.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function url()
    {
        return $this->belongsTo(Url::class, 'route_id');
    }

    /**
     * Return URL hyperlink.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return $this->url ? $this->url->uri : '';
    }

    /**
     * Get all categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getSelection()
    {
        return static::get()->pluck('title', 'id');
    }
}
