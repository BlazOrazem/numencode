<?php

namespace Numencode\Http\Controllers\Auth;

use Numencode\Utils\AppMailer;
use Illuminate\Http\Request;
use Numencode\Repositories\UserRepository;
use Numencode\Http\Controllers\Controller;

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
     * @param Request $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request, AppMailer $mailer)
    {
        $userData = $request->all();

        $this->validate($request, [
            'name' => 'required|max:255',
            'nickname' => $userData['nickname'] != $this->user->nickname ? 'max:255|unique:users' : '',
            'email' => $userData['email'] != $this->user->email ? 'required|email|max:255|unique:users' : '',
        ]);

        if ($userData['email'] != $this->user->email) {
            $this->user->email = $userData['email'];
            $this->user->token = str_random(30);
            $this->user->is_verified = false;
        }

        $this->user->name = $userData['name'];
        $this->user->nickname = $userData['nickname'];
        $this->user->save();

        if (!$this->user->is_verified) {
            $mailer->sendEmailVerificationTo($this->user);
            flash()->overlay(trans('messages.user_profile.title'),
                trans('messages.user_profile.verification_sent', ['email' => $this->user->email]), 'success');
        } else {
            flash()->success(trans('messages.success'), trans('messages.user_profile.profile_success'));
        }

        return redirect()->back();
    }

    /**
     * Update the user password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $userData = $request->all();
        $this->user->password = bcrypt($userData['password']);
        $this->user->save();

        flash()->success(trans('messages.success'), trans('messages.user_profile.password_success'));

        return redirect()->back();
    }
}
