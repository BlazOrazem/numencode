<?php

namespace Admin\Http;

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
