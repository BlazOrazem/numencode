<?php

namespace Numencode\Models\Traits;

trait HiddenFilter
{
	public static function bootHiddenFilter()
	{
		static::addGlobalScope('hidden', function ($builder) {
			$table = $builder->getModel()->getTable();
			$builder->whereNull($table . '.is_hidden');
		});
	}
}
