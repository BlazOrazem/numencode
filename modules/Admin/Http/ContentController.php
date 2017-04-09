<?php

namespace Admin\Http;

use Numencode\Models\Plugin;
use Numencode\Models\Content;
use Numencode\Models\Page\Page;
use Admin\Repositories\PluginRepository;
use Numencode\Models\Codelist\CodelistGroup;

class ContentController extends BaseController
{
    /**
     * The Plugin Repository.
     *
     * @var PluginRepository
     */
    protected $pluginRepository;

    /**
     * Create a new plugin controller instance.
     *
     * @param PluginRepository $pluginRepository Plugin repository
     */
    public function __construct(PluginRepository $pluginRepository)
    {
        $this->pluginRepository = $pluginRepository;
    }

    /**
     * Display a listing of the always displayed contents.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contents = Content::whereNull('page_id')->get();

        return view('admin::contents.index', compact('contents'));
    }

    /**
     * Show the always displayed content create form.
     *
     * @param Page $page Content can belong to a page.
     *
     * @return \Illuminate\View\View
     */
    public function create(Page $page = null)
    {
        $contents = Content::whereNull('page_id')->get();
        $positions = CodelistGroup::find(2)->items;
        $pages = Page::tree();

        js(['plugins' => Plugin::orderBy('title')->get()->toArray()]);

        return view('admin::contents.create', compact('contents', 'positions', 'page', 'pages'));
    }

    /**
     * Store a newly created always displayed content.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'position'   => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (Content::create([
            'page_id'       => isset(request()->page_id) ? request()->page_id : null,
            'title'         => request()->title,
            'lead'          => request()->lead,
            'body'          => request()->body,
            'plugin_id'     => isset(request()->plugin_id) ? request()->plugin_id : null,
            'plugin_params' => isset(request()->params) ? request()->params : null,
            'sort_order'    => request()->sort_order,
        ])) {
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
        $plugin = Plugin::find($content->plugin_id);
        $positions = CodelistGroup::find(2)->items;
        $pages = Page::tree();

        if ($content->plugin_id) {
            js(['plugin_id' => $content->plugin_id]);
            $pluginForm = $this->pluginRepository->renderPluginForm($plugin, $content->plugin_params);
        }

        js(['plugins' => Plugin::orderBy('title')->get()->toArray()]);

        return view('admin::contents.edit', [
            'content'    => $content,
            'positions'  => $positions,
            'pages'      => $pages,
            'pluginForm' => isset($pluginForm) ? $pluginForm : null]
        );
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
            return success();
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
