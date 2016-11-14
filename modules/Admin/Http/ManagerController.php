<?php

namespace Admin\Http;

use Numencode\Models\Manager;
use Admin\Repositories\ManagerRepository;

class ManagerController extends BaseController
{
    /**
     * The Manager Repository implementation.
     *
     * @var ManagerRepository
     */
    protected $managers;

    /**
     * Create a new profile controller instance.
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::managers.create');
    }

    /**
     * Show the form for editing the specified manager.
     *
     * @param int $id Manager Id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $manager = Manager::findOrFail($id);

        return view('admin::managers.edit', compact('manager'));
    }

    /**
     * Update the specified manager in storage.
     *
     * @param int $id Manager Id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $manager = Manager::findOrFail($id);

        $this->validate(
            request(),
            [
                'name'     => 'required|max:255',
                'email'    => request()->email == $manager->email ? '' : 'required|email|max:255|unique:managers',
                'password' => empty($this->password) ? '' : 'required|min:6',
    //            'avatar'   => 'mimes:jpg,jpeg,png,gif,bmp',
            ]
        );

//        $this->managers->updateManager($manager, $request);

        flash()->success(
            trans('admin::messages.success'),
            trans('admin::messages.manager.updated', ['name' => $manager->name])
        );

        return redirect()->back();
    }

    /**
     * Delete the manager.
     *
     * @param int $id Manager Id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);

        $manager->delete();

        flash()->success(
            trans('admin::messages.success'),
            trans('admin::messages.manager.deleted'), 2000
        );

        return redirect()->back();
    }
}
