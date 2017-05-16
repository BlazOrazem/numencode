<?php

namespace Numencode\Models\Promotion;

use Laraplus\Data\Translatable;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\System\Traits\Sortable;

class PromotionItem extends Model
{
    use Translatable, Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotion_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['promotion_category_id', 'title', 'lead', 'body', 'link', 'sort_order'];

    /**
     * Promotion item belongs to promotion category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PromotionCategory::class, 'promotion_category_id');
    }
}
