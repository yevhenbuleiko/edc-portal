<?php

namespace App\Helpers\Contracts;

use App;

Interface HelpersContracts {

	// Common
	public static function itemAliasByInfo($fnd, $itemNames);
	// Images
	public static function saveImage($fnd, $name, $img, $item, $folder, $size=[]);
	public static function deleteImage($fnd, $name, $item_id, $folder, $deleteFolder=False);

	// Ajax
	public static function ajaxUserFoundationValidation($fnd, $usr);

	// Commands
	public static function foundationByAlias($alias);
	public static function validationCommandParametrs(array $keyValueParams);

}