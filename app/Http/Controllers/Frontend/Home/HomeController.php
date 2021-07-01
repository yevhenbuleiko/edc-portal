<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Frontend\Home\HomeUtils as Utils;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends BasicController
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
        return Inertia::render('Frontend/Home/Home');
    }
    
}
