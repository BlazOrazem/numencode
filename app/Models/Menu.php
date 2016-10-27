<?php

namespace Numencode\Models;

use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'title', 'ord'];

    /**
     * Return all menus with page tree structure.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllWithTree()
    {
        $menus = Menu::all();

        foreach ($menus as &$menu) {
            $menu->tree = static::buildTreeMenu($menu->code);
        }

        return $menus;
    }

    /**
     * Create page tree structure.
     *
     * @param $code
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function buildTreeMenu($code)
    {
        $items = Page::with('url')->where('menu', $code)->get()->groupBy('parent_id');
        
        if (count($items)) {
            $items['root'] = $items[''];
            unset($items['']);
        }
        
        return $items;
    }
}
