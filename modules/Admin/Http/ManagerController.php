<?php

namespace Admin\Http;

use Numencode\Models\Manager;
use Illuminate\Validation\Rule;
use Admin\Repositories\ManagerRepository;

class ManagerController extends BaseController
{
    /**
     * The Manager Repository.
     *
     * @var ManagerRepository
     */
    protected $managers;

    /**
     * Create a new manager controller instance.
     *
     * @param ManagerRepository $managers Manager repository
     */
    public function __construct(ManagerRepository $managers)
    {
        parent::__construct();

        $this->managers = $managers;
    }

    /**
     * Display a listing of the managers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $managers = Manager::all();

        return view('admin::managers.list', compact('managers'));
    }

    /**
     * Show the form for creating a new manager.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::managers.create');
    }

    /**
     * Store a newly created manager.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        //        $this->validate(request(), [
//            'title'      => 'required|unique:plugins',
//            'action'     => 'required',
//            'sort_order' => 'required|integer',
//        ]);

//        if (request()->ajax()) {
//            return ajaxSuccess();
//        }

//        if (Plugin::create(array_merge(request()->all(), ['is_hidden' => isset(request()->is_hidden)]))) {
//            flash()->success(
//                trans('admin::messages.success'),
//                trans('admin::plugins.created', ['name' => request()->title])
//            );
//        }

        return redirect()->route('manager.index');
    }

    /**
     * Show the form for editing the specified manager.
     *
     * @param Manager $manager Manager
     *
     * @return \Illuminate\View\View
     */
    public function edit(Manager $manager)
    {
        return view('admin::managers.edit', compact('manager'));
    }

    /**
     * Update the manager.
     *
     * @param Manager $manager Manager
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Manager $manager)
    {
        $this->validate(request(), [
            'name'     => ['required', 'max:255', Rule::unique('managers')->ignore($manager->id)],
            'email'    => ['required', 'email', Rule::unique('managers')->ignore($manager->id)],
            'password' => empty(request()->password) ? '' : 'required|min:6',
            'avatar'   => empty(request()->avatar) ? '' : 'mimes:jpg,jpeg,png,gif,bmp',
        ]);

        if (request()->ajax()) {
            return ajaxSuccess();
        }

        //$this->managers->updateManager($manager, $request);

        if ($manager->update(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::managers.updated', ['name' => request()->name])
            );
        }

        return redirect()->route('managers.index');
    }

    /**
     * Delete the manager.
     *
     * @param Manager $manager Manager
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manager $manager)
    {
        return $this->deleteThe($manager, 'managers.deleted');
    }
}
