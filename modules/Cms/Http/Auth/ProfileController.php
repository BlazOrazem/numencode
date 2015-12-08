<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Cms\Repositories\UserRepository;
use Cms\Http\Requests\ProfileRequest;

class ProfileController extends BaseController
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

        $this->middleware('isAuthenticated');

        $this->users = $users;
    }

    /**
     * Page with profile update form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('theme::profile.update');
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
