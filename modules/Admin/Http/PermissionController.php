<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\Permission;

class PermissionController extends BaseController
{
    /**
     * Redirect to roles and permissions display.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('roles.index');
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
                trans('admin::messages.permissions.created', ['name' => request()->name]));
        }

        return redirect()->route('roles.index');
    }

    /**
     * Show the permission edit form and roles to which this permission is assigned.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::with('roles')->find($id);

        return view('admin::roles.permission', compact('permission'));
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
                trans('admin::messages.permissions.updated', ['name' => request()->name]));
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
                'msg' => trans('admin::messages.permissions.deleted'),
            ];
        }

        return reportError();
    }
}
