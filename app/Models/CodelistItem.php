<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class CodelistItem extends Model
{
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'codelist_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'title', 'sort_order'];

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Create a new instance and associate it with the given codelist group.
     *
     * @param CodelistGroup $codelistGroup
     * @return static
     */
    public static function forGroup(CodelistGroup $codelistGroup)
    {
        $codelistItem = new static;

        $codelistItem->codelist_group_id = $codelistGroup->id;

        return $codelistItem;
    }
}
