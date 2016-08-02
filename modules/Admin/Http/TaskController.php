<?php

namespace Admin\Http;

use Numencode\Models\Task;

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
    
        $this->js(['data' => $tasks, 'template' => '#tasks-template']);

        return view('admin::task.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }
}
