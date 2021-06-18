<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //$start = microtime(true);
        $this->middleware(function ($request, $next) {

            $this->fnd = $request['foundation'];
            $this->usr = $request->user();

            // dd($this->fnd->users()->get());

            return $next($request);
        });
        //echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 8).' сек.';
    }
}