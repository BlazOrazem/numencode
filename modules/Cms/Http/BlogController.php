<?php

namespace Cms\Http;

use Numencode\Models\Blog\BlogItem;
use Numencode\Models\Blog\BlogCategory;
use Numencode\Models\Blog\BlogItemComment;

class BlogController extends BaseController
{
    /**
     * Display a blog category.
     *
     * @param object $params Parameters
     *
     * @return \Illuminate\View\View
     */
    public function category($params)
    {
        $blogCategory = BlogCategory::find($params->category_id);

        return view('theme::blog.category', compact('blogCategory'));
    }

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

    /**
     * Add comment to a blog post.
     *
     * @param BlogItem $blogItem Blog entry
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(BlogItem $blogItem)
    {
        $this->validate(request(), [
            'comment' => 'required',
        ]);

        $blogItem->comments()->create([
            'user_id' => auth()->user()->id,
            'is_published' => true,
            'comment' => request()->comment,
        ]);

        return redirect()->back();
    }
}
