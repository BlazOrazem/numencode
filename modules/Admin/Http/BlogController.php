<?php

namespace Admin\Http;

use Numencode\Models\Blog\BlogItem;
use Admin\Repositories\RouteRepository;
use Numencode\Models\Blog\BlogCategory;
use Numencode\Models\Blog\BlogItemComment;

class BlogController extends BaseController
{
    /**
     * Display a listing of the blog categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::blog.index', ['blogCategories' => BlogCategory::all()]);
    }

    /**
     * Show the form for creating a new blog category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::blog.category_create', ['blogCategories' => BlogCategory::all()]);
    }

    /**
     * Store a newly created blog category.
     *
     * @param RouteRepository $route Route repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RouteRepository $route)
    {
        $this->validate(request(), [
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($category = BlogCategory::create(request()->all())) {
            $category->route_id = $route->saveUrl(null, request()->title, 'BlogController@category', ['id' => $category->id]);
            $category->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::blog.category_created', ['name' => request()->title])
            );
        }

        return redirect()->route('blog.index');
    }

    /**
     * Show the blog category edit form.
     *
     * @param BlogCategory $blogCategory Blog category
     *
     * @return \Illuminate\View\View
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('admin::blog.category_edit', compact('blogCategory'));
    }

    /**
     * Update the Blog category.
     *
     * @param BlogCategory    $blogCategory Blog category
     * @param RouteRepository $route        Route repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogCategory $blogCategory, RouteRepository $route)
    {
        $blogCategory = BlogCategory::find($blogCategory->id);

        $this->validateWithBag('categoryErrors', request(), [
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($blogCategory->update(request()->all())) {
            $blogCategory->route_id = $route->saveUrl(request()->link, request()->title, 'BlogController@category', ['id' => $blogCategory->id]);
            $blogCategory->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::blog.category_updated', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('blog.edit', compact('blogCategory'));
        }

        return redirect()->route('blog.index');
    }

    /**
     * List the items in this category.
     *
     * @param BlogCategory $blogCategory Blog category
     *
     * @return \Illuminate\View\View
     */
    public function items(BlogCategory $blogCategory)
    {
        return view('admin::blog.category_items', compact('blogCategory'));
    }

    /**
     * Delete the Blog category.
     *
     * @param BlogCategory $blogCategory Blog category
     *
     * @return array
     * @throws \Exception
     */
    public function destroy(BlogCategory $blogCategory)
    {
        return $this->deleteThe($blogCategory, 'blog.category_deleted');
    }

    /**
     * Edit the blog item.
     *
     * @param BlogCategory $blogCategory Blog category
     *
     * @return \Illuminate\View\View
     */
    public function createItem(BlogCategory $blogCategory = null)
    {
        $categories = BlogCategory::all();

        return view('admin::blog.item_create', compact('blogCategory', 'categories'));
    }

    /**
     * Store a newly created blog item.
     *
     * @param RouteRepository $route Route repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem(RouteRepository $route)
    {
        $this->validateWithBag('itemErrors', request(), [
            'blog_category_id' => 'required',
            'title'            => 'required',
        ]);

        if (request()->ajax()) {
            return success();
        }

        $blogCategory = BlogCategory::find(request()->blog_category_id);

        if ($blogItem = BlogItem::forCategory($blogCategory)->fill(request()->all())) {
            $blogItem->save();
            $blogItem->route_id = $route->saveUrl(null, $blogCategory->title . '-' . request()->title, 'BlogController@item', ['id' => $blogItem->id]);
            $blogItem->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::blog.item_created', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('blog.item.edit', compact('blogItem'));
        }

        return redirect()->route('blog.items', compact('blogCategory'));
    }

    /**
     * Edit the blog item.
     *
     * @param BlogItem $blogItem Blog entry
     *
     * @return \Illuminate\View\View
     */
    public function editItem(BlogItem $blogItem)
    {
        $categories = BlogCategory::all();

        return view('admin::blog.item_edit', compact('blogItem', 'categories'));
    }

    /**
     * Update the blog item.
     *
     * @param BlogItem        $blogItem Codelist item
     * @param RouteRepository $route    Route repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem(BlogItem $blogItem, RouteRepository $route)
    {
        $blogItem = BlogItem::find($blogItem->id);
        
        $this->validateWithBag('itemErrors', request(), [
            'blog_category_id' => 'required',
            'title'            => 'required',
        ]);

        if (request()->ajax()) {
            return success();
        }

        $blogCategory = BlogCategory::find(request()->blog_category_id);

        if ($blogItem->update(request()->all())) {
            $blogItem->route_id = $route->saveUrl(request()->link, $blogCategory->title . '-' . request()->title, 'BlogController@item', ['id' => $blogItem->id]);
            $blogItem->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::blog.item_updated', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('blog.item.edit', compact('blogItem'));
        }

        return redirect()->route('blog.items', compact('blogCategory'));
    }

    /**
     * Delete the blog item.
     *
     * @param BlogItem $blogItem Codelist item
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyItem(BlogItem $blogItem)
    {
        return $this->deleteThe($blogItem, 'blog.item_deleted');
    }

    /**
     * List the blog entry comments.
     *
     * @param BlogItem $blogItem Blog entry
     *
     * @return \Illuminate\View\View
     */
    public function comments(BlogItem $blogItem)
    {
        return view('admin::blog.item_comments', compact('blogItem'));
    }

    /**
     * Update the blog entry comment.
     *
     * @return array
     */
    public function updateComment()
    {
        $comment = BlogItemComment::find(request()->pk);
        $comment->comment = request()->value;
        $comment->save();

        return success();
    }

    /**
     * Publish the comment.
     *
     * @param BlogItemComment $comment Blog entry comment
     *
     * @return void
     */
    public function publishComment(BlogItemComment $comment)
    {
        $comment->is_published = $comment->is_published ? null : true;
        $comment->save();
    }

    /**
     * Delete the blog entry comment.
     *
     * @param BlogItemComment $comment Blog entry comment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyComment(BlogItemComment $comment)
    {
        return $this->deleteThe($comment, 'blog.comment_deleted');
    }
}
