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
        $view->with('pageTree', $this->pageTreeStructure());
    }

	/**
	 * Create page tree structure.
	 *
	 * @return mixed
	 */
	public function pageTreeStructure()
	{
		$pages = Page::orderBy('ord')->get()->groupBy('parent_id');

		if (count($pages)) {
			$pages['root'] = $pages[''];
			unset($pages['']);
		}

		return $pages;
	}
}
