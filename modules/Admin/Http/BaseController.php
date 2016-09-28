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
    
        $pages = Page::orderBy('ord')->get();
        
        $flat = [];
        foreach ($pages as $page){
            $flat[$page->parent_id ?: 0][] = $page;
        }

        view()->share('pageTree', $this->createTree($flat, $flat[0]));
    }

    /**
     * Create page tree structure.
     *
     * @param $list
     * @param $parent
     * @return array
     */
    protected function createTree(&$list, $parent)
    {
        $tree = [];

        foreach ($parent as $item){
            $tree[] = $item;
            if (!isset($list[$item->id])) continue;
            $item->children = $this->createTree($list, $list[$item->id]);
        }

        return $tree;
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
