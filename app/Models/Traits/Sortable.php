<?php

namespace Numencode\Models\Traits;

use Exception;
use Numencode\Models\Scopes\SortableScope;

/**
 * Sortable model trait
 *
 * Usage:
 * Model table must have 'ord' table column.
 *
 * In the model class definition:
 *   use \Numencode\Models\Traits\Sortable;
 *
 * To set orders:
 *   $model->setSortableOrder($recordIds, $recordOrders);
 *
 * You can change the sort field used by declaring:
 *   const SORT_ORDER = 'my_sort_order';
 */
trait Sortable
{
    /**
     * Boot the sortable trait for this model.
     *
     * @return void
     */
    public static function bootSortable()
    {
        static::created(
            function ($model) {
                $sortOrderColumn = $model->getSortOrderColumn();

                if (!$model->$sortOrderColumn) {
                    $model->setSortableOrder($model->id);
                }
            }
        );

        static::addGlobalScope(new SortableScope);
    }

    /**
     * Sets the sort order of records to the specified orders.
     * If the orders is undefined, the record identifier is used.
     *
     * @param int|array $itemIds    Item ids
     * @param null      $itemOrders Item orders
     *
     * @throws Exception
     * @return void
     */
    public function setSortableOrder($itemIds, $itemOrders = null)
    {
        if (!is_array($itemIds)) {
            $itemIds = [$itemIds];
        }

        if ($itemOrders === null) {
            $itemOrders = $itemIds;
        }

        if (count($itemIds) != count($itemOrders)) {
            throw new Exception('Invalid setSortableOrder call - count of itemIds do not match count of itemOrders');
        }

        foreach ($itemIds as $index => $id) {
            $order = $itemOrders[$index];
            $this->newQuery()->where('id', $id)->update([$this->getSortOrderColumn() => $order]);
        }
    }

    /**
     * Get the name of the "sort order" column.
     *
     * @return string
     */
    public function getSortOrderColumn()
    {
        return defined('static::SORT_ORDER') ? static::SORT_ORDER : 'sort_order';
    }
}
