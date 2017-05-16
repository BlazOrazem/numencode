<?php

namespace Cms\Http;

use Numencode\Models\Promotion\PromotionCategory;

class HomeController extends BaseController
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $promotions = PromotionCategory::find(1)->items;

        return view('theme::pages.home', compact('promotions'));
    }
}
