<?php

namespace Numencode\Models\Page;

use Numencode\Models\System\Url;
use Numencode\Models\Content\Content;

trait Relations
{
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
}
