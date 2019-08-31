<?php

namespace Admin\Http;

use Illuminate\Validation\Rule;
use Numencode\Models\User\Role;
use Numencode\Models\User\Manager;
use Admin\Repositories\ManagerRepository;

class ManagerController extends BaseController
{
    /**
     * The Manager Repository.
     *
     * @var ManagerRepository
     */
    protected $managerRepository;

    /**
     * Create a new manager controller instance.
     *
     * @param ManagerRepository $managerRepository Manager repository
     */
    public function __construct(ManagerRepository $managerRepository)
    {
        parent::__construct();

        $this->managerRepository = $managerRepository;
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $this->validate(request(), [
            'name'      => 'required|max:255|unique:managers',
            'email'     => 'required|email|unique:managers',
            'password'  => 'required|min:6',
            'avatar'    => empty(request()->avatar) ? '' : 'mimes:jpg,jpeg,png,gif,bmp',
        ]);

        if (request()->ajax()) {
            return success();
        }

        $manager = $this->managerRepository->create();

        flash()->success(
            trans('admin::messages.success'),
            trans('admin::managers.created', ['name' => $manager->name])
        );

        return redirect()->route('managers.edit', [$manager]);
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
        $roles = $this->admin()->can('assign_manager_roles') ? Role::where('is_admin', true)->get() : null;

        return view('admin::managers.edit', compact('manager', 'roles'));
    }

    /**
     * Update the manager.
     *
     * @param Manager $manager Manager
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
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
            return success();
        }

        if ($this->managerRepository->update($manager)) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::managers.updated', ['name' => request()->name])
            );
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('admin::managers.profile');
    }

    /**
     * Update the profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateProfile()
    {
        $this->validate(request(), [
            'name'     => ['required', 'max:255', Rule::unique('managers')->ignore($this->admin()->id)],
            'email'    => ['required', 'email', Rule::unique('managers')->ignore($this->admin()->id)],
            'password' => empty(request()->password) ? '' : 'required|min:6',
            'avatar'   => empty(request()->avatar) ? '' : 'mimes:jpg,jpeg,png,gif,bmp',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($this->managerRepository->update($this->admin())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::managers.profile_updated')
            );
        }

        return redirect()->back();
    }

    /**
     * Delete the manager.
     *
     * @param Manager $manager Manager
     *
     * @return array
     * @throws \Exception
     */
    public function destroy(Manager $manager)
    {
        if (in_array($manager->id, config('numencode.protected_managers'))) {
            return [
                'type'  => 'error',
                'title' => trans("admin::messages.error"),
                'msg'   => trans("admin::managers.delete_failed"),
            ];
        }

        return $this->deleteThe($manager, 'managers.deleted');
    }

    /**
     * Save managers tasks.
     *
     * @return void
     */
    public function saveTasks()
    {
        $this->admin()->update(['tasks' => request()->all()]);
    }
}
