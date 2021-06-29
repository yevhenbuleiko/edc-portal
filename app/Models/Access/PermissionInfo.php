<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Access\Permission;

class PermissionInfo extends Model
{
    use HasFactory;

    protected $table = 'permissions_info';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'permission_id',
        'langkey',
    ];

    /**
    * Get Permission
    */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
