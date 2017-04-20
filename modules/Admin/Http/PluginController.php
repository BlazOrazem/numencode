<?php

namespace Admin\Http;

use Numencode\Models\Plugin;
use Illuminate\Validation\Rule;
use Admin\Repositories\PluginRepository;

class PluginController extends BaseController
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
        parent::__construct();

        $this->pluginRepository = $pluginRepository;
    }

    /**
     * Display a listing of the plugin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plugins = Plugin::withoutGlobalScope('hidden')->get();

        return view('admin::plugins.index', compact('plugins'));
    }

    /**
     * Store a newly created plugin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'title'      => 'required|unique:plugins',
            'action'     => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (Plugin::create(array_merge(request()->all(), [
            'params' => isset(request()->params) ? request()->params : null,
            'is_hidden' => isset(request()->is_hidden) ?: null,
        ]))) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::plugins.created', ['name' => request()->title])
            );
        }

        return redirect()->route('plugins.index');
    }

    /**
     * Show the plugin edit form.
     *
     * @param Plugin $plugin Plugin
     *
     * @return \Illuminate\View\View
     */
    public function edit(Plugin $plugin)
    {
        $params = [];

        if ($plugin->params) {
            foreach ($plugin->params as $key => $param) {
                $params[$key] = [
                    'index'   => $key,
                    'label'   => $param->label,
                    'name'    => $param->name,
                    'type'    => $param->type,
                ];

                if (isset($param->options)) {
                    $params[$key]['options'] = $param->options;
                }
            }
        }

        js(['plugin_params' => $params]);

        return view('admin::plugins.edit', compact('plugin'));
    }

    /**
     * Update the plugin.
     *
     * @param Plugin $plugin Plugin
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Plugin $plugin)
    {
        $this->validate(request(), [
            'title'      => ['required', Rule::unique('plugins')->ignore($plugin->id)],
            'action'     => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($plugin->update(array_merge(request()->all(), [
            'params' => isset(request()->params) ? request()->params : null,
            'is_hidden' => isset(request()->is_hidden) ?: null,
        ]))) {

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::plugins.updated', ['name' => request()->title])
            );
        }

        return redirect()->route('plugins.index');
    }

    /**
     * Delete the plugin.
     *
     * @param Plugin $plugin Plugin
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Plugin $plugin)
    {
        return $this->deleteThe($plugin, 'plugins.deleted');
    }

    /**
     * Call plugin api.
     *
     * @return void
     */
    public function api()
    {
        $plugin = Plugin::findOrFail(request()->id);

        if (!$plugin->params) {
            return success();
        }

        return $this->pluginRepository->renderPluginForm($plugin);
    }

    public function testRender()
    {
        $plugin = Plugin::find(3);

        return $this->pluginRepository->renderPluginForm($plugin);
    }
}
