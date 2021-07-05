<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    protected $table = 'chatrooms';

    protected $modelKey = 'chatrooms';
    protected $withChatRoom = false;
    protected static $filterKeys = [];
    protected static $orderKeys = [];
    protected static $infoByLangKeys = [
        'chatrooms.*', 
        'chatrooms_info.name', 
        'chatrooms_info.desc'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias', 'valid', 'blocked', 'published', 'temp', 'from_date', 'to_date', 'created_by_id', 'modified_by_id', 'deleted_at', 'foundation_id', 'status'
    ];

    /**
    *  Scope Personal
    */
    public function scopeSatatus($query, $status=null)
    {   
        if($personal == null) { return $query; }

        return $query->where('status', $status);
    }
    
    /**
    *  Get Owner Item
    */
    public function chatroomable()
    {
        return $this->morphTo();
    }

    // /**
    // *  Get Children
    // */
    // public function children() 
    // {
    //     return $this->hasMany(self::class, 'parent_id')->with('infobylang');
    // }
    // /**
    // *  Get Parent
    // */
    // public function parent()
    // {
    //     return $this->belongsTo(self::class, 'parent_id')->with('infobylang');
    // }
}
