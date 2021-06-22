<?php

namespace App\Http\Controllers\Backend\Access;

use App\Http\Controllers\BasicController;
use App\Models\Access\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends BasicController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fnd)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fnd)
    {
        //
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
     * @param  \App\Models\Access\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($fnd, Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Access\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($fnd, Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Access\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fnd, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Access\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($fnd, Permission $permission)
    {
        //
    }
}
