<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class FriendsMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('friends');
        Capsule::schema()->create('friends', function($table) {
            $table->integer('user_id')->index();
            $table->integer('friend_id')->index();
            $table->primary(['user_id', 'friend_id']);
        });
    }
}