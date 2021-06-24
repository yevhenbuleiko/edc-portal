<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasCan;
use App;

use App\Models\Foundation\Foundation;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasCan;

    protected $modelKey = 'users';
    protected $withChatRoom = false;
    protected static $filterKeys = [];
    protected static $orderKeys = [];
    protected static $infoByLangKeys = [
        'users.*', 
        'users_info.first_name', 
        'users_info.middle_name', 
        'users_info.last_name', 
        'users_info.about'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'can',
    ];

    /* - Scope - */

    /**
    * Scope Left Join With Info By Current Lang;
    */
    public function scopeInfobylang($query) {
        // return $query->leftJoin($this->modelKey.'_info', function ($join) {
        //     $join->on($this->modelKey.'.id', '=', $this->modelKey.'_info.'.substr($this->modelKey, 0, -1).'_id')
        //         ->where($this->modelKey.'_info.langkey', App::getLocale());
        // });

        return $query->select(self::$infoByLangKeys)->leftJoin('users_info', function ($join) {
            $join->on('users.id', '=', 'users_info.'.'user_id')
                ->where('users_info.langkey', App::getLocale());
        });
    }

    /* - Relationships - */

     /**
    *  Get Info
    */
    public function info()
    {
        return $this->hasMany(get_class($this).'Info', $this->modelKey.'_id');
    }

    /**
     * Foundations
     */
    public function foundations()
    {
        return $this->belongsToMany(Foundation::class, 'foundations_users', 'user_id', 'foundation_id');
    }

    /* - Utils - */

    /**
     * If User Has Role
     */
    public function hasRole($role) {
        return false;
    }

    /**
     * If User Has Permission
     */
    public function hasPermission($perm) {
        return true;
    }


}
