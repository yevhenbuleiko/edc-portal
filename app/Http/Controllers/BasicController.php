<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

//use App\Models\Foundation\Foundation;
//use App\Models\User;

class BasicController extends Controller
{
    protected $utils;
    protected $pageKey;
    // User
    protected $usr = NULL;
    protected $fnd = NULL;
    protected $settings;
    protected $decor;
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
        // echo '---11111---';

        // $fnd_alias = $request->fnd;
        // $fnd = Foundation::where('alias', $fnd_alias)->firstOrFail();
        // //$request['currentFnd'] = $fnd;
        // dd($request['ckey']);
        // dd($fnd);

        // $start = microtime(true);
        $this->middleware(function ($request, $next) {

            $this->fnd  = $request['currentFnd'];
            $this->usr  = $request->user();

            $this->settings = [];
            $this->decor = [];

            // $this->settings = $this->fnd->settings->pluck('value', 'title');
            // $this->decor = $this->fnd->decors->pluck('value', 'title');
            // // 
            // Inertia::share('z', fn (Request $request) => [
            //     'perms' => ($this->usr !== null)? $this->usr->perms()->byfnd($this->fnd->id)->get()->pluck('alias') : [],
            //     'fndSettings' => $this->settings,
            //     'fndDecor'    => $this->decor
            // ]);

            return $next($request);
        });
        // echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 8).' сек.';
    }

}
