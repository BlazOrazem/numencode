<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\Permission;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('admin::permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created permission.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validateWithBag('permissionErrors', request(), [
            'name' => 'required|unique:permissions',
            'label' => 'required',
            'sort_order'  => 'required|integer'
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if (Permission::create([
            'name' => snake_slug(request()->name),
            'label' => ucfirst(request()->label),
            'sort_order' => request()->sort_order,
        ])) {
            flash()->success(trans('admin::messages.success'),
                trans('admin::roles.permission.created', ['name' => request()->name]));
        }

        return redirect()->route('roles.index');
    }

    /**
     * Show the permission edit form.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $permission = Permission::find($id);

        return view('admin::permissions.edit', compact('permissions', 'permission'));
    }

    /**
     * Update the permission.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $permission = Permission::findOrFail($id);

        $this->validateWithBag('groupErrors', request(), [
            'name' => ['required', Rule::unique('permissions')->ignore($id)],
            'label' => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if ($permission->update([
            'name' => snake_slug(request()->name),
            'label' => ucfirst(request()->label),
            'sort_order' => request()->sort_order,
        ])) {
            flash()->success(trans('admin::messages.success'),
                trans('admin::roles.permission.updated', ['name' => request()->name]));
        }

        return redirect()->route('roles.index');
    }

    /**
     * Delete the permission.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->delete()) {
            return [
                'title' => trans('admin::messages.success'),
                'msg' => trans('admin::roles.permission.deleted'),
            ];
        }

        return reportError();
    }
}
