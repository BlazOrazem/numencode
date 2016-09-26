<?php

namespace Admin\Http;

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

        return view('admin::task.list', compact('tasks'));
    }

    /**
     * Delete the task.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->back();
    }
}
