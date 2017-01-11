<?php

namespace Admin\Http;

use Numencode\Models\Plugin;
use Illuminate\Validation\Rule;

class PluginController extends BaseController
{
    /**
     * Display a listing of the plugin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plugins = Plugin::all();

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
            return ajaxSuccess();
        }

        if (Plugin::create(array_merge(request()->all(), ['is_hidden' => isset(request()->is_hidden)]))) {
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
        $plugins = Plugin::all();

        return view('admin::plugins.edit', compact('plugins', 'plugin'));
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
            return ajaxSuccess();
        }

        if ($plugin->update(array_merge(request()->all(), ['is_hidden' => isset(request()->is_hidden)]))) {
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
            return ajaxSuccess();
        }

        return $this->renderPluginForm($plugin);
    }

    public function testRender()
    {
        $plugin = Plugin::find(2);

        return $this->renderPluginForm($plugin);
    }

    /**
     * Create form for plugin params.
     *
     * @param Plugin $plugin Plugin
     * @return \Illuminate\View\View
     */
    protected function renderPluginForm(Plugin $plugin)
    {
        $data = collect($plugin->params)->map(function ($item) {
            if ($item->type == 'select') {
                $item->options = eval("return " . $item->options . ';');
            }

            $item->label = ucfirst($item->name);

            return $item;
        });

        return view('admin::plugins.form', compact('data'));
    }
}
