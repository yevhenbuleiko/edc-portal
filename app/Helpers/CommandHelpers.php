<?php

namespace App\Helpers;

use App\Helpers\Contracts\CommandContracts;
use App\Models\Currency; 
use App\Models\Language; 

class CommandHelpers implements CommandContracts
{   

    /**
     * Validation Params For Commands
     *
     * @return boolean
     */
    public static function validationCommandParametrs(array $paramsKeyAndValue) {

        $res = array();

        foreach ($paramsKeyAndValue as $key => $value) {
            switch ($key) {
                case 'alias':
                    if(!self::check_fnd_alias_param($paramsKeyAndValue['alias'])) {
                        $res['alias']='ERROR PARAMETER: alias (valid characters: a-z, A-Z, 0-9, -, _) min:2 characters, max:15 characters';
                    }
                    break;
                case 'langs':
                    if(!self::check_fnd_langs_param($paramsKeyAndValue['langs'])) {
                        $res['langs'] = 'ERROR PARAMETER: langs (the specified language is not in the list).';
                    }
                    break;
                case 'currencies':
                    if(!self::check_fnd_currencies_param($paramsKeyAndValue['currencies'])) {
                        $res['currencies'] = 'ERROR PARAMETER: currencies (the specified currency code is not in the list).';
                    }
                    break;
                case 'email':
                    if(!self::check_email_param($paramsKeyAndValue['email'])) {
                        $res['email'] = 'ERROR PARAMETER: not valid email';
                    }
                    break;
                case 'passwd':
                    if(!self::check_password_param($paramsKeyAndValue['passwd'])) {
                        $res['passwd'] = 'ERROR PARAMETER: not valid password. Min: 8 characters';
                    }
                    break;
                default:
                    break;
            }
        }
        return $res;
    }

    /* Helpers */
    public static function check_fnd_alias_param($alias) {
       
        return preg_match("/^[a-zA-Z0-9_-]{2,15}$/",trim($alias));
    }

    private static function check_fnd_langs_param($langs) {
        //$langs_keys = array_keys(Config::get('dataseeds.languages'));
        $langs_keys = Language::all()->pluck('lang')->toArray();
        foreach ($langs as $lk) {
            if (!in_array($lk, $langs_keys)) { return false; }
        }
        return true;
    }

    private static function check_fnd_currencies_param($currencies) {
        $currencies_codes = Currency::all()->pluck('code')->toArray();
        foreach ($currencies as $cc) {
            if (!in_array($cc, $currencies_codes)) { return false; }
        }
        return true;
    }

    public static function check_email_param($email) {
        $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
        $email = strtolower(trim($email));

        return preg_match ($regex, $email);
    }

    public static function check_password_param($pwd) {
        if(strlen(trim($pwd)) < 8) { return false; }
        return true;

        //return preg_match("/^[a-zA-Z0-9_-.=@#$&]{2,15}$/",trim($alias));
    }

}