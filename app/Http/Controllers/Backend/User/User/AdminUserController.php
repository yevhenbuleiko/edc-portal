<?php

namespace App\Http\Controllers\Backend\User\User;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Backend\User\User\AdminUtilsUser as Utils;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends BasicController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Utils $utils)
    {
        parent::__construct($request);
        $this->authorizeResource(User::class);

        $this->utils = $utils;

        $this->middleware(function ($request, $next) {
    
            Inertia::share('dp', fn () => $this->utils->data );

            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fnd)
    {
        $users = $this->fnd->users()->infobylang()->get();
        return Inertia::render('Backend/User/User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fnd)
    {
        return Inertia::render('Backend/User/User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $fnd)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($fnd, User $user)
    {
        return Inertia::render('Backend/User/User/Show', [
            'user' => $user, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($fnd, User $user)
    {
        return Inertia::render('Backend/User/User/Edit', [
            'user' => $user, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fnd, User $user)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);
        $user->update($request->only('name', 'email'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($fnd, User $user)
    {
        //
    }
}
