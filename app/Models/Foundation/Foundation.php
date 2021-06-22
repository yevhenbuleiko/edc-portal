<?php

namespace App\Models\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Foundation extends Model
{
    use HasFactory;
    use SoftDeletes;

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
}
