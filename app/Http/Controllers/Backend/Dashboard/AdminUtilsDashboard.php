<?php

namespace App\Http\Controllers\Backend\Dashboard;

use Illuminate\Support\Facades\Config;
use Lang;

class AdminUtilsDashboard
{
    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['titles'] = [
            'dashboard'   => Lang::get('transfer.dashboard-title'),
            'access'      => Lang::get('transfer.access-title'),
            'roles'       => Lang::get('transfer.roles-title'),
            'permissions' => Lang::get('transfer.permissions-title'),
            'users'       => Lang::get('transfer.users-title'),
        ];
        $this->data['values']   = [];
        $this->data['settings'] = [];

    }
}
