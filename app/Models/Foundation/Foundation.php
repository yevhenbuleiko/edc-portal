<?php

namespace App\Models\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Chatroom;

use App\Models\User;

class Foundation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Chatroom;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias',
    ];

    /* - Relationships - */

    /**
     * Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'foundations_users', 'foundation_id', 'user_id');
    }

      /**
    * Get Languages.
    */
    public function languages()
    {
        return $this->belongsToMany('App\Models\Language', 'foundations_languages', 'foundation_id', 'langkey');
    }
     /**
    * Get Currencies.
    */
    public function currencies()
    {
        return $this->belongsToMany('App\Models\Currency', 'foundations_currencies', 'foundation_id', 'currency_id');
    }

     /**
    *  Get Roles
    */
    public function roles()
    {
        return $this->hasMany('App\Models\Access\Role');
    }
    /**
    *  Get Permissions
    */
    public function permissions()
    {
        return $this->hasMany('App\Models\Access\Permission');
    }

     /**
    *  Get Settings
    */
    public function settings()
    {
        return $this->morphMany('App\Models\Foundation\Setting', 'settingable');
    }
    
     /**
    *  Get Decors
    */
    public function decors()
    {
        return $this->morphMany('App\Models\Foundation\Decor', 'decorable');
    }
}
