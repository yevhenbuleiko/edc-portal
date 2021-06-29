<?php

namespace App\Traits;

use App;

trait ItemInfo {

	public function scopeInfobylang($query) {
        return $query->select(self::$infoByLangKeys)->leftJoin($this->modelKey.'_info', function ($join) {
            $join->on($this->modelKey.'.id', '=', $this->modelKey.'_info.'.substr($this->modelKey, 0, -1).'_id')
                ->where($this->modelKey.'_info.langkey', App::getLocale());
        });
    }

	public function info()
    {
        return $this->hasMany(get_class($this).'Info', substr($this->modelKey, 0, -1).'_id');
    }
}