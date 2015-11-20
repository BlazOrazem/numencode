<?php

namespace Numencode\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Numencode\Repositories\UserRepository;
use Numencode\Http\Controllers\Controller;
use Numencode\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * The User Repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile controller instance.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        parent::__construct();

        $this->middleware('auth');

        $this->users = $users;
    }

    /**
     * Page with profile update form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile.update');
    }

    /**
     * Display the specified user profile.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the user profile.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $this->users->updateUser($this->user, $request);

        flash()->success(trans('messages.success'), trans('messages.user_profile.profile_success'));

        return redirect()->back();
    }
}
