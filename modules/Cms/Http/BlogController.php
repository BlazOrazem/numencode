<?php

namespace Cms\Http;

use Numencode\Models\Blog\BlogItem;

class BlogController extends BaseController
{
    /**
     * Display a random blog entry.
     *
     * @return \Illuminate\View\View
     */
    public function random()
    {
        $randomBlog = BlogItem::inRandomOrder()->first();

        return view('theme::blog.show', compact('randomBlog'));
    }
}
