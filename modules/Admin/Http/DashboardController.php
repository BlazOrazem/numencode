<?php

namespace Admin\Http;

use Admin\Repositories\DashboardRepository;

class DashboardController extends BaseController
{
    /**
     * The Dashboard Repository.
     *
     * @var DashboardRepository
     */
    protected $dashboardRepository;

    /**
     * Create a new dashboard controller instance.
     *
     * @param DashboardRepository $dashboardRepository Dashboard repository
     */
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (config('numencode.analytics')) {
            $this->dashboardRepository->loadAnalytics();
        }

        js(['manager_tasks' => $this->admin()->tasks]);

        return view('admin::pages.dashboard');
    }

    /**
     * Template elements overview
     *
     * @return \Illuminate\View\View
     */
    public function elements()
    {
        return view('admin::pages.tpl_elements');
    }
}
