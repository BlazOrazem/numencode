<?php

namespace Numencode\Models\Blog;

use Laraplus\Data\Translatable;
use Numencode\Models\System\Url;
use Illuminate\Database\Eloquent\Model;

class BlogItem extends Model
{
    use Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['blog_category_id', 'title', 'lead', 'body'];

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
     * Blog item belongs to blog category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    /**
     * Blog item has many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(BlogItemComment::class);
    }

    /**
     * Blog item has published comments.
     *
     * @return object
     */
    public function publishedComments()
    {
        return $this->comments->filter(function ($value) {
            return $value->is_published;
        });
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
     * Create a new instance and associate it with the given blog category.
     *
     * @param BlogCategory $blogCategory Blog category
     *
     * @return static
     */
    public static function forCategory(BlogCategory $blogCategory)
    {
        $blogItem = new static;

        $blogItem->blog_category_id = $blogCategory->id;

        return $blogItem;
    }
}
