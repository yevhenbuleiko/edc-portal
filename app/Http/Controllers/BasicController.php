<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Lang;

class BasicController extends Controller
{
    protected $utils;
    protected $pageKey;
    // User
    protected $usr = NULL;
    protected $fnd = NULL;

    // Context
    protected $pageCtx = [];
    protected $userCtx = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

        // $start = microtime(true);
        $this->middleware(function ($request, $next) {

            $this->fnd  = $request['currentFnd'];
            $this->usr  = $request->user();

            return $next($request);
        });
        // echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 8).' сек.';
    }

}
