<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatroomInfo extends Model
{
    use HasFactory;

    protected $table = 'chatrooms_info';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'lang',
        'chatroom_id'
    ];

    /**
    * Get Cahtroom
    */
    public function chatroom()
    {
        return $this->belongsTo('App\Models\Chat\Chatroom');
    }
}
