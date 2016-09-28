<?php

namespace Admin\Http;

use Illuminate\Http\Request;
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

        return view('admin::tasks.list', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::tasks.create');
    }

    /**
     * Store a newly created task.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Task::create($request->all());

        flash()->success(trans('admin::messages.success'), trans('admin::messages.tasks.created'));

        return redirect(route('tasks.index'));
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
