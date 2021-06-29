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
use App\Traits\ItemInfo;
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
    use ItemInfo;

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
