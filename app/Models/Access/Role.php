<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Foundation\Foundation;
use App\Models\Access\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasCan;
use App\Traits\ItemInfo;
use App\Traits\Chatroom;
use App;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasCan;
    use ItemInfo;
    use Chatroom;

    protected $modelKey = 'roles';
    protected $withChatRoom = false;
    protected static $filterKeys = [];
    protected static $orderKeys = [];
    protected static $infoByLangKeys = [
        'roles.*', 
        'roles_info.name', 
        'roles_info.desc', 
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias', 'chatable', 'temp', 'from_date', 'to_date', 'valid', 'blocked', 'created_by_id', 'modified_by_id', 'deleted_at', 'foundation_id', 'status'
    ];

    /* Relationships */
    /**
    * Get Foundation
    */
    public function foundation()
    {
        return $this->belongsTo(Foundation::class);
    }
    /**
    *  Get Permissions
    */
    public function permissions()
    {
      return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id');
    }

    /**
    *  Get Users.
    */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_roles', 'role_id', 'user_id')->withPivot('pv_valid', 'pv_published', 'pv_temp', 'pv_added_at', 'pv_from_date', 'pv_to_date', 'pv_context');
    }

}
