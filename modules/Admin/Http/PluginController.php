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
        $this->validate(
            request(),
            [
                'title'      => 'required|unique:plugins',
                'action'     => 'required',
                'sort_order' => 'required|integer',
            ]
        );

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if (Plugin::create(array_merge(request()->all(),
            [
                'is_hidden' => isset(request()->is_hidden),
            ]
        ))) {
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
     * @param int $id Plugin Id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $plugins = Plugin::all();
        $plugin = Plugin::find($id);

        return view('admin::plugins.edit', compact('plugins', 'plugin'));
    }

    /**
     * Update the plugin.
     *
     * @param int $id Plugin Id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $plugin = Plugin::findOrFail($id);

        $this->validate(
            request(),
            [
                'code'       => ['required', Rule::unique('plugins')->ignore($id)],
                'title'      => 'required',
                'sort_order' => 'required|integer',
            ]
        );

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if ($plugin->update(
            [
                'code'       => snake_slug(request()->code),
                'title'      => ucfirst(request()->title),
                'sort_order' => request()->sort_order,
            ]
        )) {
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
     * @param int $id Plugin Id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $permission = Plugin::findOrFail($id);

        if ($permission->delete()) {
            return [
                'title' => trans('admin::messages.success'),
                'msg'   => trans('admin::plugins.deleted'),
            ];
        }

        return reportError();
    }
}
