<?php

namespace Admin\Http;

use Numencode\Models\Role;
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
        return redirect(route('roles.index'));
    }
}
