<?php

namespace Cms\Http;

use Numencode\Models\Task;
use Cms\Mailers\UserMailer;

class TaskController extends BaseController
{
    public function __construct(UserMailer $mailer)
    {
        parent::__construct();

        $this->mailer = $mailer;
    }

    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::latest()->get();

        return view('theme::tasks.list', compact('tasks'));
    }

    /**
     * Sample method. Will be removed soon.
     *
     * @param $params
     * @return \Illuminate\View\View
     */
    public function sample($params)
    {
        return view('theme::tasks.sample', ['sample' => json_decode($params)]);
    }

    public function sendTestMail()
    {
        $this->mailer->sendEmailTestTo('dev@numencode.com');

        return 'Email test sent.';
    }
}
