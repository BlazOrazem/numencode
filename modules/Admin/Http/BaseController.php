<?php

namespace Admin\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Numencode\Models\Page;

class BaseController extends Controller
{
    /**
     * Authenticated manager implementation.
     *
     * @var Manager
     */
    protected $admin;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->admin = Auth::guard('admin')->user();

        view()->share('admin', $this->admin);
        view()->share('signedIn', (bool)Auth::guard('admin')->check());

        view()->share('pageTree', $this->pageTreeStructure());
    }

    /**
     * Build page tree structure.
     *
     * @param null $parent
     * @return array
     */
    protected function pageTreeStructure($parent = null)
    {
        $pages = Page::where('parent_id', $parent)->orderBy('ord')->get();

        $treeArray = [];

        foreach ($pages as $row) {
            $treeArray[$row->id] = $row;

            if ($row->parent_id != $parent) {
                continue;
            }

            $treeArray[$row->id]['children'] = $this->pageTreeStructure($row->id);

            if(empty($treeArray[$row->id]['children'])) {
                unset($treeArray[$row->id]['children']);
            }
        }

        return $treeArray;
    }

    /**
     * Pass data to Javascript
     *
     * @param $data
     */
    protected function js($data)
    {
        JavaScriptFacade::put($data);
    }
}
