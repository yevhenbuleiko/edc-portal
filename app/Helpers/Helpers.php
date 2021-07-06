<?php

namespace App\Helpers;

use App\Helpers\Contracts\HelpersContracts;
use Illuminate\Support\Facades\Auth;

use App\Models\Foundation\Foundation;
use App\Models\Currency; 
use App\Models\Language; 

use Carbon\Carbon;
use Session;
use Config;
use Storage;
use Gate;
use Image;
use View;
use Lang;
use App;


class Helpers implements HelpersContracts
{   

    /**
     * Get Alias Stirng By Foundation Alias And Item Info
     *
     * @return string
     */
    public static function itemAliasByInfo($fnd, $names) {
        if( isset(array_values($names)[0]) ) {
            return $fnd->id.'-'.array_values($names)[0].':'.array_keys($names)[0];
        } 
        return NULL;
    }


    /**
     * Save Image.
     *
     * @return void
     */
    public static function saveImage($fnd, $name, $img, $item, $ukey, $size=[]) {
    
        $extension = $img->getClientOriginalExtension();

        $img = Image::make($img);

        if(!empty($size)) {
            $img->resize($size[0], $size[1], function ($constraint) {
                $constraint->aspectRatio();                 
            });
        }

        $img->stream(); 

        $img_path = $fnd->alias . '/'. $ukey . '/' . $item->id;

        self::deleteLogo($fnd, $item, $ukey);

        Storage::disk('public')->put($img_path.'/'.$name.'.'.$extension, $img);
        
        $item->$name = $name .'.'. $extension;
        $item->save();
    }
    

    /**
     * Delete Image.
     *
     * @return void
     */
    public static function deleteImage($fnd, $name, $item_id, $ukey, $deleteFolder=False) {
        $file_path = $fnd->alias .'/'. $ukey. '/' . $item_id;

        foreach (Config::get('settings.image_types') as $img_type) {
            if(Storage::disk('public')->exists($file_path.'/'. $name .'.'.$img_type)) {
                Storage::disk('public')->delete($file_path.'/'. $name .'.'.$img_type);
            }
        }

        if ($deleteFolder) {
            $dir_path = Storage::disk('public')->url($file_path);
            $files = Storage::files($dir_path);
            if(empty($files)) {
                Storage::disk('public')->deleteDirectory($file_path);
            }
        }
    }

    /* Ajax */

    /**
     * Validation User And Foundation
     *
     * @return void
     */
    public static function ajaxUserFoundationValidation($fnd, $usr) {
        if($fnd == null) {
            return False;
        }
        return $usr->isValidBy($fnd);
    }

    /* Commands */
    /**
     * Checking The Existence Of An Foundation
     *
     * @return boolean
     */
    public static function foundationByAlias($alias) {
        return Foundation::where('alias', $alias)->first();
    }
    /**
     * Validation Params For Commands
     *
     * @return boolean
     */
    // public static function validationCommandParametrs(array $paramsKeyAndValue) {

    //     $res = array();

    //     foreach ($paramsKeyAndValue as $key => $value) {
    //         switch ($key) {
    //             case 'alias':
    //                 if(!self::check_fnd_alias_param($paramsKeyAndValue['alias'])) {
    //                     $res['alias']='ERROR PARAMETER: alias (valid characters: a-z, A-Z, 0-9, -, _) min:2 characters, max:15 characters';
    //                 }
    //                 break;
    //             case 'langs':
    //                 if(!self::check_fnd_langs_param($paramsKeyAndValue['langs'])) {
    //                     $res['langs'] = 'ERROR PARAMETER: langs (the specified language is not in the list).';
    //                 }
    //                 break;
    //             case 'currencies':
    //                 if(!self::check_fnd_currencies_param($paramsKeyAndValue['currencies'])) {
    //                     $res['currencies'] = 'ERROR PARAMETER: currencies (the specified currency code is not in the list).';
    //                 }
    //                 break;
    //             case 'email':
    //                 if(!self::check_email_param($paramsKeyAndValue['email'])) {
    //                     $res['email'] = 'ERROR PARAMETER: not valid email';
    //                 }
    //                 break;
    //             case 'passwd':
    //                 if(!self::check_password_param($paramsKeyAndValue['passwd'])) {
    //                     $res['passwd'] = 'ERROR PARAMETER: not valid password. Min: 8 characters';
    //                 }
    //                 break;
    //             default:
    //                 break;
    //         }
    //     }
    //     return $res;
    // }

    /* Helpers */
    // public static function check_fnd_alias_param($alias) {
       
    //     return preg_match("/^[a-zA-Z0-9_-]{2,15}$/",trim($alias));
    // }

    // private static function check_fnd_langs_param($langs) {
    //     //$langs_keys = array_keys(Config::get('dataseeds.languages'));
    //     $langs_keys = Language::all()->pluck('lang')->toArray();
    //     foreach ($langs as $lk) {
    //         if (!in_array($lk, $langs_keys)) { return false; }
    //     }
    //     return true;
    // }

    // private static function check_fnd_currencies_param($currencies) {
    //     $currencies_codes = Currency::all()->pluck('code')->toArray();
    //     foreach ($currencies as $cc) {
    //         if (!in_array($cc, $currencies_codes)) { return false; }
    //     }
    //     return true;
    // }

    // public static function check_email_param($email) {
    //     $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
    //     $email = strtolower(trim($email));

    //     return preg_match ($regex, $email);
    // }

    // public static function check_password_param($pwd) {
    //     if(strlen(trim($pwd)) < 8) { return false; }
    //     return true;

    //     //return preg_match("/^[a-zA-Z0-9_-.=@#$&]{2,15}$/",trim($alias));
    // }

}