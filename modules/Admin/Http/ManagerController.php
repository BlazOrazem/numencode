<?php

namespace Admin\Http;

use Numencode\Models\Manager;
use Admin\Repositories\ManagerRepository;
use Admin\Http\Requests\ManagerUpdateRequest;

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
     * @param ManagerRepository $managers
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
     * Store a newly created resource in storage.
     *
     * @param FlyerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function store(FlyerRequest $request)
//    {
//        $flyer = $this->user->publish(
//            new Flyer($request->all())
//        );
//
//        flash()->success('Success!', 'Your flyer has been created.');
//
//        return redirect(flyer_path($flyer));
//    }

    /**
     * Display the specified manager.
     *
     * @param int $id Manager ID
     * @return \Illuminate\View\View
     */
//    public function show($id)
//    {
//        $manager = Manager::firstOrFail($id);
//        dd($manager);
//
//        return view('flyers.show', compact('flyer'));
//    }

    /**
     * Show the form for editing the specified manager.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $manager = Manager::findOrFail($id);

        return view('admin::managers.edit', compact('manager'));
    }

	/**
     * Update the specified resource in storage.
     *
     * @param ManagerUpdateRequest $request
     * @param Manager $manager
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateRequest $request, Manager $manager)
    {
        $this->managers->updateManager($manager, $request);

        flash()->success(
            trans('admin::messages.success'), trans('admin::messages.profile.updated', ['name' => $manager->name])
        );

        return redirect()->back();
    }

    /**
     * Delete the manager.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);

        $manager->delete();

        return redirect()->back();
    }
}
