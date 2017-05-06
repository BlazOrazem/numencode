<?php

namespace Numencode\Models\Page;

use Numencode\Models\Content\Menu;

trait Attributes
{
    /**
     * Return URL hyperlink.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return $this->url ? $this->url->uri : '';
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
