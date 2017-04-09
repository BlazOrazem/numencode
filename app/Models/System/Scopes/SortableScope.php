<?php

namespace Numencode\Models\System\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model as ModelBase;
use Illuminate\Database\Eloquent\Builder as BuilderBase;

class SortableScope implements Scope
{
    /**
     * Applied scope.
     *
     * @var $scopeApplied
     */
    protected $scopeApplied;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param BuilderBase $builder Builder base
     * @param ModelBase   $model   Model base
     *
     * @return void
     */
    public function apply(BuilderBase $builder, ModelBase $model)
    {
        $this->scopeApplied = true;

        $builder->getQuery()->orderBy($model->getSortOrderColumn());
    }
}
