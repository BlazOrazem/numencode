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
     * Display a random task.
     *
     * @return \Illuminate\View\View
     */
    public function random()
    {
        $task = Task::inRandomOrder()->first();

        return view('theme::tasks.show', compact('task'));
    }

    /**
     * Display a specific task.
     *
     * @param object $params Data parameters
     *
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
