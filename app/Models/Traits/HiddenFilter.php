<?php

namespace Numencode\Models\Traits;

trait HiddenFilter
{
    /**
     * Boot the hidden filter trait for this model.
     *
     * @return void
     */
	public static function bootHiddenFilter()
	{
		static::addGlobalScope('hidden', function ($builder) {
			$table = $builder->getModel()->getTable();
			$builder->whereNull($table . '.is_hidden');
		});
	}
}
