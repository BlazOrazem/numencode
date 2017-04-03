<?php

namespace Numencode\Utils;

use Cache;
use Numencode\Models\Page;

class MenuBuilder
{
    /**
     * Menu code.
     *
     * @var string
     */
    protected $code;

    /**
     * Create a new MenuBuilder instance.
     *
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Render the menu.
     *
     * @return string
     */
    public function render()
    {
        $key = 'menu_' . $this->code . '_' . app()->getLocale();

        return Cache::remember($key, null, function () {
            $menu = Page::where('menu', $this->code)
                ->whereNull('parent_id')
                ->get();

            if (!$menu) {
                return '';
            }

            return view('theme::menus.' . $this->code, compact('menu'))->render();
        });
    }

    /**
     * Attempt to render the menu.
     *
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (\Exception $e) {
            return $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine();
        }
    }
}
