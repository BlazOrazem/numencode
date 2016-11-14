<?php

namespace Admin\Http;

use Numencode\Models\Role;
use Illuminate\Validation\Rule;
use Numencode\Models\Permission;

class RoleController extends BaseController
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin::roles.index', compact('roles'));
    }

    /**
     * Store a newly created role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(
            request(),
            [
                'name'        => 'required|unique:roles',
                'label'       => 'required',
                'sort_order'  => 'required|integer',
            ]
        );

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if (Role::create(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::roles.created', ['name' => request()->name])
            );
        }

        return redirect()->route('roles.index');
    }

    /**
     * Show the role edit form and assign permissions to a given role.
     *
     * @param int $id Role Id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::with('permissions', 'managers', 'users')->findOrFail($id);
        $permissions = Permission::where('is_admin', $role->is_admin)->get();

        return view('admin::roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the role.
     *
     * @param int $id Role Id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $role = Role::findOrFail($id);

        $this->validate(
            request(),
            [
                'name'       => ['required', Rule::unique('roles')->ignore($id)],
                'label'      => 'required',
                'sort_order' => 'required|integer',
            ]
        );

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if ($role->update(
            [
                'name' => snake_slug(request()->name),
                'label' => ucfirst(request()->label),
                'sort_order' => request()->sort_order,
                'is_admin' => isset(request()->is_admin),
            ]
        )) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::roles.updated', ['name' => request()->name])
            );
        }

        return redirect()->back();
    }

    /**
     * Delete the role.
     *
     * @param int $id Role Id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->delete()) {
            return [
                'title' => trans('admin::messages.success'),
                'msg'   => trans('admin::roles.deleted'),
            ];
        }

        return reportError();
    }

    /**
     * Attach or detach permission on a given role.
     *
     * @param int $roleId       Role Id
     * @param int $permissionId Permission Id
     *
     * @return void
     */
    public function assignPermission($roleId, $permissionId)
    {
        $role = Role::findOrFail($roleId);

        $role->permissions()->toggle($permissionId);
    }
}
