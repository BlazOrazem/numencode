<?php

namespace Cms\Http;

use Numencode\Models\Blog\BlogItem;

class BlogController extends BaseController
{
    /**
     * Display a random blog entry.
     *
     * @param integer $blogItemID Blog item ID
     *
     * @return \Illuminate\View\View
     */
    public function show($blogItemID)
    {
        $blogItem = BlogItem::find($blogItemID);

        return view('theme::blog.show', compact('blogItem'));
    }

    /**
     * Display a random blog entry.
     *
     * @return \Illuminate\View\View
     */
    public function random()
    {
        $randomBlog = BlogItem::inRandomOrder()->first();

        return view('theme::blog.random', compact('randomBlog'));
    }
}
