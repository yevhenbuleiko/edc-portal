<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Foundation\Foundation;
use App\Models\Access\Role;
use App\Models\User;
use App\Traits\HasCan;
use App\Traits\ItemInfo;
use App;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasCan;
    use ItemInfo;

    protected $modelKey = 'permissions';
    protected $withChatRoom = false;
    protected static $filterKeys = [];
    protected static $orderKeys = [];
    protected static $infoByLangKeys = [
        'permissions.*', 
        'permissions_info.name', 
        'permissions_info.desc', 
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias', 'for', 'for_number', 'number', 'valid', 'blocked', 'created_by_id', 'modified_by_id', 'deleted_at', 'foundation_id', 'status'
    ];

    /* - Scope - */

    /**
    *  Scope By Group(for)
    */
    public function scopeByfnd($query, $fndId)
    {
        return $query->where('foundation_id', $fndId);
    }

    /**
    *  Scope By Group(for)
    */
    public function scopeBy($query, $by=[])
    {
        return $query->whereIn('for', $by);
    }

    /* - Relationships - */
    /**
    * Get Foundation
    */
    public function foundation()
    {
        return $this->belongsTo(Foundation::class);
    }
    /**
    *  Get Roles
    */
    public function roles()
    {
      return $this->belongsToMany(Role::class, 'roles_permissions', 'permission_id', 'role_id');
    }


}
