<?php

namespace App\Models\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

     protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'title', 'by', 'value', 'settingable_id', 'settingable_type', 'foundation_id'
    ];

    /**
     * Get Settingable Item.
     */
    public function settingable()
    {
        return $this->morphTo();
    }
}
