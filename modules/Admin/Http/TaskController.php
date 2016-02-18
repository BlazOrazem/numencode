<?php

namespace Admin\Http;

use Admin\Models\Task;

class TaskController extends BaseController
{
    /**
     * Display a listing of the  managers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::latest()->get();

        $this->js(compact('tasks'));

        return view('admin::task.list', compact('tasks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
    }
}
