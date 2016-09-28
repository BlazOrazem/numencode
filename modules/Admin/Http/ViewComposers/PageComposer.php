<?php

namespace Admin\Http\ViewComposers;

use Illuminate\View\View;
use Numencode\Models\Page;

class PageComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pageTree', $this->createPageTree());
    }

    /**
     * Create page tree structure.
     *
     * @param array $tree
     * @return array
     */
    protected function createPageTree($tree = [])
    {
        $pages = Page::orderBy('ord')->get();

        foreach ($pages as $page){
            $tree[$page->parent_id ?: 0][] = $page;
        }

        return $this->buildTree($tree, $tree[0]) ;
    }

    /**
     * Build page tree structure.
     *
     * @param $list
     * @param $parent
     * @return array
     */
    protected function buildTree(&$list, $parent)
    {
        $tree = [];

        foreach ($parent as $item){
            $tree[] = $item;
            if (!isset($list[$item->id])) continue;
            $item->children = $this->buildTree($list, $list[$item->id]);
        }

        return $tree;
    }
}
