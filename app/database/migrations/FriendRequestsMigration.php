<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class FriendRequestsMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('friend_requests');
        Capsule::schema()->create('friend_requests', function($table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('sender_id')->index();
            $table->integer('recipient_id')->index();
            $table->timestamps();
        });
    }
}