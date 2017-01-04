<?php

namespace Admin\Http;

use Numencode\Models\User;
use Numencode\Models\Role;
use Illuminate\Validation\Rule;
use Admin\Repositories\UserRepository;

class UserController extends BaseController
{
    /**
     * The User Repository.
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new user controller instance.
     *
     * @param UserRepository $userRepository User repository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

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

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::users.create');
    }

    /**
     * Store a newly created user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'avatar'   => empty(request()->avatar) ? '' : 'mimes:jpg,jpeg,png,gif,bmp',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        $user = $this->userRepository->create();

        flash()->success(
            trans('admin::messages.success'),
            trans('admin::users.created', ['name' => $user->name])
        );

        return redirect()->route('users.edit', [$user]);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user User
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = $this->admin()->can('assign_user_roles') ? Role::where('is_admin', false)->get() : null;

        return view('admin::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the user.
     *
     * @param User $user User
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user)
    {
        $this->validate(request(), [
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users',
            'password' => empty(request()->password) ? '' : 'required|min:6',
            'avatar'   => empty(request()->avatar) ? '' : 'mimes:jpg,jpeg,png,gif,bmp',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        if ($this->userRepository->update($user)) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::users.updated', ['name' => request()->name])
            );
        }

        return redirect()->back();
    }

    /**
     * Delete the user.
     *
     * @param User $user User
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        return $this->deleteThe($user, 'users.deleted');
    }
}
