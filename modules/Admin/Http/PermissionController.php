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
        $this->validate(request(), [
            'name'        => 'required|unique:permissions',
            'label'       => 'required',
            'sort_order'  => 'required|integer',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if (Permission::create([
                'name'       => snake_slug(request()->name),
                'label'      => ucfirst(request()->label),
                'sort_order' => request()->sort_order,
            ])
        ) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::permissions.created', ['name' => request()->name])
            );
        }

        return redirect()->route('permissions.index');
    }

    /**
     * Show the permission edit form.
     *
     * @param Permission $permission Permission
     *
     * @return \Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $permissions = Permission::all();

        return view('admin::permissions.edit', compact('permissions', 'permission'));
    }

    /**
     * Update the permission.
     *
     * @param Permission $permission Permission
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Permission $permission)
    {
        $this->validate(request(), [
            'name'       => ['required', Rule::unique('permissions')->ignore($permission->id)],
            'label'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if ($permission->update([
                'name'       => snake_slug(request()->name),
                'label'      => ucfirst(request()->label),
                'sort_order' => request()->sort_order,
            ])
        ) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::permissions.updated', ['name' => request()->name])
            );
        }

        return redirect()->route('permissions.index');
    }

    /**
     * Delete the permission.
     *
     * @param Permission $permission Permission
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        if ($permission->delete()) {
            return [
                'title' => trans('admin::messages.success'),
                'msg'   => trans('admin::permissions.deleted'),
            ];
        }

        return reportError();
    }
}
