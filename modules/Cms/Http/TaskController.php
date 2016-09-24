<?php

namespace Cms\Http;

use Numencode\Models\Task;

class TaskController extends BaseController
{
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
}
