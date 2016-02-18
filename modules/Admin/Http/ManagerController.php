<?php

namespace Admin\Http;

use JavaScript;
use Admin\Models\Manager;

class ManagerController extends BaseController
{
    /**
     * Display a listing of the  managers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $managers = Manager::all();

        $this->js(['data' => $managers, 'template' => '#managers-template']);

        return view('admin::manager.list');
    }

    /**
     * Show the form for creating a new manager.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::manager.create');
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
     * @param Manager $manager
     * @return \Illuminate\View\View
     */
    public function edit(Manager $manager)
    {
        return view('admin::manager.edit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manager $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $manager->delete();
    }
}
