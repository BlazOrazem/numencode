<?php

namespace Numencode\Models\Promotion;

use Laraplus\Data\Translatable;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\System\Traits\Sortable;

class PromotionCategory extends Model
{
    use Translatable, Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotion_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'lead', 'body', 'sort_order'];

    /**
     * Promotion category has many items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(PromotionItem::class);
    }
}
