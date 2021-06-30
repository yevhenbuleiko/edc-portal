<?php

namespace App\Http\Controllers\Backend\User\User;

use Illuminate\Support\Facades\Config;
use Lang;

class AdminUtilsUser 
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
            'new-user'    => Lang::get('transfer.new-user-title'),
            'edit-user'   => Lang::get('transfer.edit-user-title'),
            'user'        => Lang::get('transfer.user-title'),
            'name'        => Lang::get('transfer.name-title'),
            'desc'        => Lang::get('transfer.desc-title'),
        ];
        $this->data['values']   = [];
        $this->data['settings'] = [];

    }

}
