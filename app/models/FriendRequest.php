<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class FriendRequest extends Eloquent {
    protected $table = 'friend_requests';

    public function sender() {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function recipient() {
        return $this->belongsTo('App\Models\User', 'recipient_id');
    }
}