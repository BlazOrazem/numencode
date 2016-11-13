<?php

namespace Admin\Http;

use Numencode\Models\Role;
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
        $this->validateWithBag('roleErrors', request(), [
            'name' => 'required|unique:roles',
            'label' => 'required',
            'sort_order'  => 'required|integer'
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if (Role::create(request()->all())) {
            flash()->success(trans('admin::messages.success'),
                trans('admin::roles.created', ['name' => request()->name]));
        }

        return redirect()->route('roles.index');
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
                'msg' => trans('admin::roles.deleted'),
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
