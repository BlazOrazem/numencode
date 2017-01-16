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
     * Show a single task.
     *
     * @param $params
     * @return \Illuminate\View\View
     */
    public function show($params)
    {
        return view('theme::tasks.show', [
            'data' => $params,
            'task' => Task::find($params->task_id),
        ]);
    }
}
