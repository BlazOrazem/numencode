<?php

namespace App\Http\Controllers\Auth;

use App\Utils\AppMailer;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * User Repository.
     *
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        parent::__construct();

        $this->middleware('auth');

        $this->users = $users;
    }

    /**
     * Display a profile update page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.update');
    }

    /**
     * Display the specified user profile.
     *
     * @param  int  $id
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
            'name'     => 'required|max:255',
            'nickname' => $userData['nickname'] != $this->user->nickname ? 'max:255|unique:users' : '',
            'email'    => $userData['email'] != $this->user->email ? 'required|email|max:255|unique:users' : '',
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
            flash()->overlay("Profile updated", "Email verification link has been sent to your email address.\\nPlease check your inbox and click on the link.", "success");
        } else {
            flash()->success("Success", "Your profile was successfully updated.");
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

        flash()->success("Success", "Your password was successfully updated.");

        return redirect()->back();
    }

}
