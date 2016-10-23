<?php

namespace Numencode\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
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
     * @return $items \Illuminate\Database\Eloquent\Collection
     */
    public static function buildTreeMenu($code)
    {
        $items = Page::with('url')->where('menu', $code)->orderBy('ord')->get()->groupBy('parent_id');
        
        if (count($items)) {
            $items['root'] = $items[''];
            unset($items['']);
        }
        
        return $items;
    }
}
