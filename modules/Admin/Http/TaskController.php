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

        return view('admin::tasks.list', compact('tasks'));
    }

    /**
     * Show the given task.
     *
     * @param Task $task Task
     *
     * @return \Illuminate\View\View
     */
    public function show(Task $task)
    {
        $task = Task::find($task->id);

        return view('admin::tasks.show', compact('task'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::tasks.create');
    }

    /**
     * Store a newly created task.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'body'  => 'required',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if (Task::create(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::tasks.created', ['name' => request()->title])
            );
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Show the task edit form.
     *
     * @param Task $task Task
     *
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $task = Task::find($task->id);

        return view('admin::tasks.edit', compact('task'));
    }

    /**
     * Update the task.
     *
     * @param Task $task Task
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task)
    {
        $this->validate(request(), [
            'title' => 'required',
            'body'  => 'required',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($task->update([
            'title' => request()->title,
            'body' => request()->body,
            'completed' => isset(request()->completed),
        ])
        ) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::tasks.updated', ['name' => request()->title])
            );
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Complete a task.
     *
     * @param Task $task Task
     */
    public function complete(Task $task)
    {
        $task->completed = $task->completed ? null : true;
        $task->save();
    }

    /**
     * Delete the task.
     *
     * @param Task $task Task
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        return $this->deleteThe($task, 'tasks.deleted');
    }
}
