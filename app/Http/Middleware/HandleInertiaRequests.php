<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

use App\Models\Foundation\Foundation;
use App\Models\User;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        // -------------------------------------------
        //$fnd = Foundation::first();
        //dd($fnd);
        //$usr = User::first();
        //dd($usr);
        //dd($usr->foundations);
        //dd($fnd->users);
        // -------------------------------------------

        // $fnd_alias = $request->fnd;
        // $fnd = Foundation::where('alias', $fnd_alias)->firstOrFail();
        // $request['currentFnd'] = $fnd;

        return array_merge(parent::share($request), [
            // 'objFnd' => $fnd,

            'objFnd' => $request['currentFnd']->only(['alias']),
            // lazy get user permissions
            'permission' => [
                'users' => function() use ($request) {
                    $usr = $request->user();
                    if($usr) {
                        return [
                            'viewAny' => $usr->can('viewAny', User::class),
                            'create'  => $usr->can('create', User::class),
                        ];
                    }
                }
            ],
        ]);
    }
}
