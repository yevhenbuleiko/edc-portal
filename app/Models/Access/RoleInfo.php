<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Access\Role;

class RoleInfo extends Model
{
    use HasFactory;

    protected $table = 'roles_info';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'role_id',
        'langkey',
    ];

    /**
    * Get Role
    */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
