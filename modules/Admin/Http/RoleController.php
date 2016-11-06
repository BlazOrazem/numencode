<?php

namespace Admin\Http;

use Validator;
use Numencode\Models\Role;
use Numencode\Models\Permission;

class RoleController extends BaseController
{
    /**
     * Display a listing of the roles and permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin::roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:roles',
            'label' => 'required',
            'sort_order'  => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'roleErrors');
        }

        if (Role::create(request()->all())) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.roles.created', ['name' => request()->title]));
        }

        return redirect(route('roles.index'));
    }

    /**
     * Show the role edit form and permissions for this role.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);

        return view('admin::roles.edit', compact('role'));
    }

    /**
     * Delete the role.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->delete()) {
            return [
                'title' => trans('admin::messages.success'),
                'msg' => trans('admin::messages.roles.deleted'),
            ];
        }

        return reportError();
    }

	/**
	 * Assign permissions to a given role.
	 *
	 * @param $roleId
	 * @return \Illuminate\View\View
	 */
	public function assignPermissions($roleId)
	{
		$role = Role::whereId($roleId)->with('permissions', 'users', 'managers')->first();
		$permissions = Permission::all();

		return view('admin::roles.assign', compact('role', 'permissions'));
	}
}
