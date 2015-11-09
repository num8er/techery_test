<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class FriendsMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('friends');
        Capsule::schema()->create('friends', function($table) {
            $table->integer('user_id');
            $table->integer('friend_id');
            $table->primary(['user_id', 'friend_id']);
        });
    }
}