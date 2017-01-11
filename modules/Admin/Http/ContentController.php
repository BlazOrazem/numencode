<?php

namespace Admin\Http;

use Numencode\Models\Plugin;
use Numencode\Models\Content;

class ContentController extends BaseController
{
    /**
     * Display a listing of the always displayed contents.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contents = Content::whereNull('page_id')->get();
        $plugins = Plugin::orderBy('title')->get();

        return view('admin::contents.index', compact('contents', 'plugins'));
    }

    /**
     * Store a newly created always displayed content.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if (Content::create(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::contents.created')
            );
        }

        return redirect()->route('contents.index');
    }

    /**
     * Show the always displayed content edit form.
     *
     * @param Content $content Always displayed content
     *
     * @return \Illuminate\View\View
     */
    public function edit(Content $content)
    {
        return view('admin::contents.edit', compact('content'));
    }

    /**
     * Update the always displayed content.
     *
     * @param Content $content Always displayed content
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Content $content)
    {
        $this->validate(request(), [
            'position'   => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if ($content->update(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::contents.updated')
            );
        }

        return redirect()->back();
    }

    /**
     * Delete the always displayed content.
     *
     * @param Content $content Always displayed content
     *
     * @return array
     */
    public function destroy(Content $content)
    {
        return $this->deleteThe($content, 'contents.deleted');
    }
}
