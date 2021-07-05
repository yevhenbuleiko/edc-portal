<?php

namespace App\Helpers;

use App\Helpers\Contracts\DataConvertorContracts;

use Carbon\Carbon;


class DataConvertors implements DataConvertorContracts
{   

    public static function toXml($data, $params) {
    	return '1000-0001999888777';
    }

    public static function fromXml($data, $dop) {
    	return '1000-0001999888777';
    }


	public static function toJson($data, $dop) {
    	return '1000-0001999888777';
    }


	public static function fromJson($data, $dop) {
    	return json_decode($data, true);
    }


	public static function toXls($data, $dop) {
    	return '1000-0001999888777';
    }

	public static function fromXls($data, $dop)  {
    	return '1000-0001999888777';
    }

}