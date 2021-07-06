<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Backend\Dashboard\AdminUtilsDashboard as Utils;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends BasicController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Utils $utils)
    {
        parent::__construct($request);
        $this->utils = $utils;

        $this->middleware(function ($request, $next) {
            Inertia::share('dp', fn () => $this->utils->data );

            return $next($request);
        });
    }
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($fnd, Request $request)
    {
        return Inertia::render('Backend/Dashboard/Dashboard');
    }
}
