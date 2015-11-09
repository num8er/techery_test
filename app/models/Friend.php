<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Friend extends Eloquent {
    protected $table = 'friends';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function friend() {
        return $this->belongsTo('App\Models\User', 'friend_id');
    }
}