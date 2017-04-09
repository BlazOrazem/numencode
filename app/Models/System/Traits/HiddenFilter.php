<?php

namespace Numencode\Models\System\Traits;

trait HiddenFilter
{
    /**
     * Boot the hidden filter trait for this model.
     *
     * @return void
     */
    public static function bootHiddenFilter()
    {
        if (!in_array('isAdmin', request()->route()->middleware())) {
            static::addGlobalScope('hidden', function ($builder) {
                $table = $builder->getModel()->getTable();
                $builder->whereNull($table . '.is_hidden');
            });
        }
    }
}
