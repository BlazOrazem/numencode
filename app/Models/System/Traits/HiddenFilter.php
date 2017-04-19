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
        if (request()->route() && !in_array('is_admin', request()->route()->middleware())) {
            static::addGlobalScope('hidden', function ($builder) {
                $table = $builder->getModel()->getTable();
                $builder->whereNull($table . '.is_hidden');
            });
        }
    }
}
