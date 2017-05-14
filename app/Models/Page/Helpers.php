<?php

namespace Numencode\Models\Page;

use Numencode\Models\Content\Content;

trait Helpers
{
    /**
     * Merge general and page contents, sort the collection by order and return.
     *
     * @param string $position Content position
     *
     * @return mixed
     */
    public function getContents($position)
    {
        $generalContents = Content::where('position', $position)->whereNull('page_id')->get();

        return $generalContents->merge($this->contents()->where('position', $position)->get())->sortBy('sort_order');
    }

    /**
     * Build tree structure for pages.
     *
     * @param string $menu Menu type
     *
     * @return \Illuminate\Support\Collection
     */
    protected function tree($menu = null)
    {
        if ($menu) {
            $items = static::where('menu', $menu)->get()->groupBy('parent_id');
        } else {
            $items = static::get()->groupBy('parent_id');
        }

        if ($items->count()) {
            $items['root'] = $items[''];
            unset($items['']);
        } else {
            $items = collect(['root' => collect()]);
        }

        return $items;
    }
}
