<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\User\User;
use Numencode\Models\User\Role;
use Numencode\Models\User\Manager;
use Numencode\Models\User\Permission;

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
     * Show the role with assigned permissions.
     *
     * @param Role $role Role
     *
     * @return \Illuminate\View\View
     */
    public function show(Role $role)
    {
        $roles = Role::all();
        $permissions = Permission::where('is_admin', $role->is_admin)->get();

        return view('admin::roles.show', compact('role', 'roles', 'permissions'));
    }

    /**
     * Store a newly created role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'name'        => 'required|unique:roles',
            'label'       => 'required',
            'sort_order'  => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
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
     * @param Role $role Role
     *
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('is_admin', $role->is_admin)->get();

        return view('admin::roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the role.
     *
     * @param Role $role Role
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role)
    {
        $this->validate(request(), [
            'name'       => ['required', Rule::unique('roles')->ignore($role->id)],
            'label'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($role->update([
                'name' => snake_slug(request()->name),
                'label' => ucfirst(request()->label),
                'sort_order' => request()->sort_order,
                'is_admin' => isset(request()->is_admin) ?: null,
            ])
        ) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::roles.updated', ['name' => request()->name])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('roles.edit', compact('role'));
        }

        return redirect()->route('roles.index');
    }

    /**
     * Delete the role.
     *
     * @param Role $role Role
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        return $this->deleteThe($role, 'roles.deleted');
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

    /**
     * Assign or un-assign role to a given manager.
     *
     * @param Manager $manager Manager
     * @param Role    $role    Role
     *
     * @return void
     */
    public function assignManagerRole(Manager $manager, Role $role)
    {
        $manager->roles()->toggle($role->id);
    }

    /**
     * Assign or un-assign role to a given user.
     *
     * @param User $user User
     * @param Role $role Role
     *
     * @return void
     */
    public function assignUserRole(User $user, Role $role)
    {
        $user->roles()->toggle($role->id);
    }
}
