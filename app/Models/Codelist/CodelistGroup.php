<?php

namespace Numencode\Models\Codelist;

use Illuminate\Database\Eloquent\Model;
use Numencode\Models\System\Traits\Sortable;

class CodelistGroup extends Model
{
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'codelist_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'sort_order'];

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Eager load selected relations.
     *
     * @var array
     */
    protected $with = ['items'];

    /**
     * Codelist group has many items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(CodelistItem::class);
    }

    /**
     * Return items for a specific codelist group.
     *
     * @param string $code Codelist group code
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function itemsFor($code)
    {
        return static::where('code', $code)->first()->items;
    }
}
