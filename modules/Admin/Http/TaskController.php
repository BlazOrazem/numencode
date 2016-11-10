<?php

namespace Admin\Http;

use Numencode\Models\Task;
use Illuminate\Http\Request;

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
     * Show the specific task.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('admin::tasks.show', compact('task'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::tasks.create', [
            'task' => new Task
        ]);
    }

    /**
     * Store a newly created task.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required'
        ]);

        Task::create($request->all());

        flash()->success(trans('admin::messages.success'), trans('admin::messages.tasks.created'));

        return redirect()->route('tasks.index');
    }
    
    /**
     * Show the form for editing the task.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('admin::tasks.edit', compact('task'));
    }

    /**
     * Update the task.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required'
        ]);

        if ($task->update($request->all())) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.tasks.updated'));
        }

        return redirect()->back();
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

        if ($task->delete()) {
            flash()->success(trans('admin::messages.success'), trans('admin::messages.tasks.deleted'));
        }

        return redirect()->back();
    }
}
