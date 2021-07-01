<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Support\Facades\Config;
use Lang;

class HomeUtils
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
            'login'       => Lang::get('transfer.login-title'),
            'logout'      => Lang::get('transfer.logout-title'),
            'register'    => Lang::get('transfer.register-title'),
            'dashboard'   => Lang::get('transfer.dashboard-title'),
        ];
        $this->data['values']   = [];
        $this->data['settings'] = [];

    }
}
