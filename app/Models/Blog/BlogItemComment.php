<?php

namespace Numencode\Models\Blog;

use Numencode\Models\User\User;
use Laraplus\Data\Translatable;
use Illuminate\Database\Eloquent\Model;

class BlogItemComment extends Model
{
    use Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_item_comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment'];

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
     * Comment belongs to a blog entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry()
    {
        return $this->belongsTo(BlogItem::class, 'blog_item_id');
    }

    /**
     * Comment belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
