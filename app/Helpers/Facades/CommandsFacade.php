<?php

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;


class CommandsFacade extends Facade 
{
	protected static function getFacadeAccessor() { return 'commandhelpers'; }
}