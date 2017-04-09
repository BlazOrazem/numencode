<?php

namespace Numencode\Models\Attributes;

use Numencode\Models\Menu;

trait PageAttributes
{
    /**
     * Return URL hyperlink.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return $this->url ? $this->url->uri : '#';
    }

    /**
     * Return page menu title.
     *
     * @return string
     */
    public function getMenuTitleAttribute()
    {
        return Menu::where('code', $this->menu)->first()->title;
    }
}
