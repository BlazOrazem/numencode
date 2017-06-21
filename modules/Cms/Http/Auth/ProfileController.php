<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Cms\Repositories\UserRepository;
use Cms\Http\Requests\ProfileRequest;

class ProfileController extends BaseController
{
    /**
     * Show the profile update form.
     *
     * @return \Illuminate\View\View
     */
    public function showProfileUpdateForm()
    {
        return view('theme::profile.update');
    }

    /**
     * Update the user profile.
     *
     * @param ProfileRequest $request    Profile request
     * @param UserRepository $repository User repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request, UserRepository $repository)
    {
        $repository->updateUser(auth()->user(), $request);

        flash()->success(trans('messages.success'), trans('messages.user_profile.profile_success'));

        return redirect()->back();
    }
}
