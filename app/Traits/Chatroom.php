<?php

namespace App\Traits;


trait Chatroom {
    
    /**
     * Get the chatrooms.
     */
    public function chatrooms()
    {
        return $this->morphMany('App\Models\Chat\Chatroom', 'chatroomable');
    }

}



