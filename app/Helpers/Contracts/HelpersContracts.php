<?php

namespace App\Helpers\Contracts;

use App;

Interface HelpersContracts {

	// Common
	public static function itemAliasByInfo($fnd, $itemNames);
	public static function foundationByAlias($alias);
	// Images
	public static function saveImage($fnd, $name, $img, $item, $folder, $size=[]);
	public static function deleteImage($fnd, $name, $item_id, $folder, $deleteFolder=False);

	// Ajax
	public static function ajaxUserFoundationValidation($fnd, $usr);

	// Commands
	// public static function validationCommandParametrs(array $keyValueParams);

}