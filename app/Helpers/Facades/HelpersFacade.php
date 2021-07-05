<?php

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;


class HelpersFacade extends Facade 
{
	protected static function getFacadeAccessor() { return 'helpers'; }
}