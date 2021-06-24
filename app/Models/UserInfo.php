<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'users_info';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'about',
        'note',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'user_id',
        'langkey',
    ];

    /**
    * Get User
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
