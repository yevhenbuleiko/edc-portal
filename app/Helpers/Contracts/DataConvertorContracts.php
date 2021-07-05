<?php

namespace App\Helpers\Contracts;

use App;

Interface DataConvertorContracts {

	// Data Transfer
	public static function toXml($data, $dop);

	public static function fromXml($data, $dop);

	public static function toJson($data, $dop);

	public static function fromJson($data, $dop);

	public static function toXls($data, $dop);

	public static function fromXls($data, $dop);
	
}