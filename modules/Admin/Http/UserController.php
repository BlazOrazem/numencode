<?php

namespace Admin\Http;

use Numencode\Models\User;

class UserController extends BaseController
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('admin::users.list', compact('users'));
    }
}
