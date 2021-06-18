<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends BasicController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
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
